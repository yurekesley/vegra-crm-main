<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Proposal;
use App\Models\ProposalHistory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $product_id = $request->query('product_id');
        $status = $request->query('status') ?? 'open';

        $products = Product::all(['id', 'name']);
        $proposals = Proposal::where('status', $status);
        $proposalCount = Proposal::all();

        if ($product_id != null && $product_id != 'null') {
            $proposals = $proposals->where('product_id', $product_id);
            $proposalCount = $proposalCount->where('product_id', $product_id);
        }

        $proposals = $proposals->paginate(10);

        $open = $proposalCount->where('status', 'open')->count();
        $approved = $proposalCount->where('status', 'approved')->count();
        $rejected = $proposalCount->where('status', 'rejected')->count();

        return view('proposals.index')
            ->with('proposals', $proposals)
            ->with('products', $products)
            ->with('filter', $filter)
            ->with('status', $status)
            ->with('product_id', $product_id)
            ->with('proposal_status', $this->translateStatus($status, true))
            ->with('status_color', $this->getStatusColor($status, true))
            ->with('open', $open)
            ->with('approved', $approved)
            ->with('rejected', $rejected);
    }

    private function translateStatus($status, $plural = false)
    {
        switch ($status) {
            case 'open':
                return 'Aberta' . ($plural ? 's' : '');
            case 'approved':
                return 'Aprovada' . ($plural ? 's' : '');
            case 'rejected':
                return 'Reprovada' . ($plural ? 's' : '');
            default:
                return 'Desconhecido';
        }
    }

    private function getStatusColor($status)
    {
        switch ($status) {
            case 'open':
                return 'yellow';
            case 'approved':
                return 'green';
            case 'rejected':
                return 'red';
            default:
                return 'gray';
        }
    }

    public function approve(Proposal $proposal, Request $request)
    {
        $old_status = $proposal->status;

        DB::transaction(function () use ($proposal, $request) {
            $proposal->status = 'approved';
            $proposal->save();

            ProposalHistory::create([
                'proposal_id' => $proposal->id,
                'content' => 'Proposta aprovada pelo usuário ' . auth()->user()->email,
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            ProposalHistory::create([
                'proposal_id' => $proposal->id,
                'content' => 'Proposta aprovada!',
                'notes' => $request->notes,
                'type' => 'status',
                'ip' => $request->ip(),
            ]);
        });

        Alert::success('Sucesso', 'Proposta aprovada com sucesso');

        return redirect()->route('proposals.index', ['status' => $proposal->old_status]);

    }

    public function open(Proposal $proposal, Request $request)
    {
        $old_status = $proposal->status;

        DB::transaction(function () use ($proposal, $request) {
            $proposal->status = 'open';
            $proposal->save();

            ProposalHistory::create([
                'proposal_id' => $proposal->id,
                'content' => 'Proposta reaberta pelo usuário ' . auth()->user()->email,
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            ProposalHistory::create([
                'proposal_id' => $proposal->id,
                'content' => 'Proposta reaberta!',
                'notes' => $request->notes,
                'type' => 'status',
                'ip' => $request->ip(),
            ]);
        });

        Alert::success('Sucesso', 'Proposta reaberta com sucesso');

        return redirect()->route('proposals.index', ['status' => $proposal->old_status]);
    }

    public function reject(Proposal $proposal, Request $request)
    {
        $old_status = $proposal->status;

        DB::transaction(function () use ($proposal, $request) {
            $proposal->status = 'rejected';
            $proposal->save();

            ProposalHistory::create([
                'proposal_id' => $proposal->id,
                'content' => 'Proposta reprovada pelo usuário ' . auth()->user()->email,
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            ProposalHistory::create([
                'proposal_id' => $proposal->id,
                'content' => 'Proposta reprovada!',
                'notes' => $request->notes,
                'type' => 'status',
                'ip' => $request->ip(),
            ]);
        });

        Alert::success('Sucesso', 'Proposta reprovada com sucesso');

        return redirect()->route('proposals.index', ['status' => $proposal->old_status]);
    }

    public function destroy(Proposal $proposal, Request $request)
    {
        DB::transaction(function () use ($proposal, $request) {
            $unit = Unit::find($proposal->unit_id);

            if ($unit != null)
            {
                $unit->status = 'free';
                $unit->save();
            }

            DB::table('proposal_payments')->where('proposal_id', $proposal->id)->delete();
            $proposal->delete();

            ProposalHistory::create([
                'proposal_id' => $proposal->id,
                'content' => 'Proposta foi excluída pelo usuário ' . auth()->user()->email,
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            ProposalHistory::create([
                'proposal_id' => $proposal->id,
                'content' => 'Proposta excluída!',
                'notes' => $request->notes,
                'type' => 'data',
                'ip' => $request->ip(),
            ]);
        });

        Alert::success('Sucesso', 'Proposta excluída com sucesso');

        return redirect()->route('proposals.index', ['status' => $proposal->status]);
    }

    public function show(Proposal $proposal)
    {
        return view('proposals.show', compact('proposal'));
    }
}
