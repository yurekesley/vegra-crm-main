<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\ProposalPayment;
use App\Models\Unit;
use App\Models\UnitGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProposalRegistrationController extends Controller
{
    public function index(Product $product)
    {
        if (!$product->allow_proposals) {
            Alert::error('Desativado', 'Desculpe, mas o cadastro de propostas está bloqueado.');
            return redirect()->route('welcome');
        }

        return view('proposals.registration.index')
            ->with('product', $product)
            ->with('prospect', null);
    }

    public function checkCode(Product $product, Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:8',
        ]);

        $code = Code::where('code', $request->code)->first();

        if ($code == null) {
            Alert::error('Não encontrado', 'O código informado não foi encontrado.');
            return redirect()->route('proposals.registration.index', $product->id);
        }

        $affected = DB::table('codes')
            ->where('code', $request->code)
            ->where('available', $code->available)
            ->where('available', '>', 0)
            ->update(['available' => $code->available - 1, 'used' => $code->used + 1]);

        if ($affected == 0) {
            Alert::error('Código utilizado', 'O código informado já foi utilizado.');
            return redirect()->route('proposals.registration.index', $product->id);
        }

        $code = Code::find($code->id);

        Alert::success('Sucesso', 'O código informado está disponível');

        return redirect()->route('proposals.registration.confirm', ['product' => $product->id, 'code' => $code->id]);
    }

    public function confirm(Product $product, Code $code, Request $request)
    {
        return view('proposals.registration.confirm')
            ->with('product', $product)
            ->with('code', $code);
    }

    public function mirror(Product $product, Code $code, Request $request)
    {
        $unit_groups = UnitGroup::where('product_id', $product->id)->get();
        $unit_groups = $unit_groups->sortBy(function ($unitGroup, $key) {
            return $unitGroup->getTranslatedType() . $unitGroup->number;
        });

        return view('proposals.registration.mirror')
            ->with('unit_groups', $unit_groups)
            ->with('product', $product)
            ->with('code', $code);
    }

    public function book(Product $product, Code $code, Unit $unit, Request $request)
    {
        $affected = DB::table('units')
            ->where('id', $unit->id)
            ->where('status', 'free')
            ->update(['status' => 'booked']);

        if ($affected == 0) {
            Alert::error('Unidade já reservada', 'A unidade acabou de ser reservada. Por favor escolha outra unidade.');
            return redirect()->route('proposals.registration.index', $product->id);
        }

        $proposal = Proposal::create([
            'code_id' => $code->id,
            'prospect_id' => $code->prospect->id,
            'product_id' => $product->id,
            'broker_id' => $code->prospect->broker_id,
            'unit_id' => $unit->id,
            'status' => 'temp',
        ]);

        Alert::success('Sucesso', 'A unidade foi reservada com sucesso.');

        return redirect()->route('proposals.registration.fill_proposal', $proposal->id);
    }

    public function fill_proposal(Proposal $proposal)
    {
        return view('proposals.registration.fill')
            ->with('proposal', $proposal);
    }

    public function store_fill_proposal(Proposal $proposal, Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,table,custom',
        ]);

        $proposal->payment_method = $request->payment_method;
        $proposal->unit_price = $proposal->product->commission_payer == 'incorporator' ? $proposal->unit->price : ($proposal->unit->price - ($proposal->unit->price * ($proposal->product->partner_commission_value / 100)));
        $proposal->house_commission_value = $proposal->unit->price * ($proposal->product->house_commission_value / 100);
        $proposal->partner_commission_value = $proposal->unit->price * ($proposal->product->partner_commission_value / 100);
        $proposal->financing_type = $proposal->unit->post_keys_financing_type;

        switch ($request->payment_method) {
            case 'cash':
                $this->store_cash_proposal($proposal, $request);
                break;
            case 'table':
                $this->store_table_proposal($proposal, $request);
                break;
            case 'custom':
                Alert::success('Sucesso', 'CUSTOM.');
                break;
        }

        $proposal->status = 'open';
        $proposal->save();

        Alert::success('Sucesso', 'Sua proposta foi enviada com sucesso e será análisada.');
        return redirect()->route('welcome');
    }

    private function store_cash_proposal(Proposal $proposal, Request $request)
    {
        $payment = ProposalPayment::create([
            'section' => 'pre_keys',
            'type' => 'cash',
            'installments' => 1,
            'installment_value' => $proposal->product->commission_payer == 'incorporator' ? $proposal->unit->price : ($proposal->unit->price - ($proposal->unit->price * ($proposal->product->partner_commission_value / 100))),
            'start_date' => $proposal->unit->pre_keys_spot_month ?? now(),
            'proposal_id' => $proposal->id,
        ]);
    }

    private function store_table_proposal(Proposal $proposal, Request $request)
    {
        $payment = ProposalPayment::create([
            'section' => 'pre_keys',
            'type' => 'cash',
            'installments' => 1,
            'installment_value' => $proposal->unit->inflow,
            'start_date' => $proposal->unit->pre_keys_spot_month ?? now(),
            'proposal_id' => $proposal->id,
        ]);

        if ($proposal->unit->pre_keys_monthly_qty > 0) {
            $payment = ProposalPayment::create([
                'section' => 'pre_keys',
                'type' => 'monthly',
                'installments' => $proposal->unit->pre_keys_monthly_qty,
                'installment_value' => $proposal->unit->pre_keys_monthly_value,
                'start_date' => $proposal->unit->pre_keys_monthly_month ?? now(),
                'proposal_id' => $proposal->id,
            ]);
        }

        if ($proposal->unit->pre_keys_monthly_qty > 0) {
            if ($proposal->unit->intermediate_start_1 != null) {
                $payment = ProposalPayment::create([
                    'section' => 'pre_keys',
                    'type' => 'intermediate',
                    'installments' => 1,
                    'installment_value' => $proposal->unit->pre_keys_intermediate_value,
                    'start_date' => $proposal->unit->intermediate_start_1 ?? now(),
                    'proposal_id' => $proposal->id,
                ]);
            }
            if ($proposal->unit->intermediate_start_2 != null) {
                $payment = ProposalPayment::create([
                    'section' => 'pre_keys',
                    'type' => 'intermediate',
                    'installments' => 1,
                    'installment_value' => $proposal->unit->pre_keys_intermediate_value,
                    'start_date' => $proposal->unit->intermediate_start_2 ?? now(),
                    'proposal_id' => $proposal->id,
                ]);
            }
            if ($proposal->unit->intermediate_start_3 != null) {
                $payment = ProposalPayment::create([
                    'section' => 'pre_keys',
                    'type' => 'intermediate',
                    'installments' => 1,
                    'installment_value' => $proposal->unit->pre_keys_intermediate_value,
                    'start_date' => $proposal->unit->intermediate_start_3 ?? now(),
                    'proposal_id' => $proposal->id,
                ]);
            }
            if ($proposal->unit->intermediate_start_4 != null) {
                $payment = ProposalPayment::create([
                    'section' => 'pre_keys',
                    'type' => 'intermediate',
                    'installments' => 1,
                    'installment_value' => $proposal->unit->pre_keys_intermediate_value,
                    'start_date' => $proposal->unit->intermediate_start_4 ?? now(),
                    'proposal_id' => $proposal->id,
                ]);

                if ($proposal->unit->intermediate_start_5 != null) {
                    $payment = ProposalPayment::create([
                        'section' => 'pre_keys',
                        'type' => 'intermediate',
                        'installments' => 1,
                        'installment_value' => $proposal->unit->pre_keys_intermediate_value,
                        'start_date' => $proposal->unit->intermediate_start_5 ?? now(),
                        'proposal_id' => $proposal->id,
                    ]);
                }
                if ($proposal->unit->intermediate_start_6 != null) {
                    $payment = ProposalPayment::create([
                        'section' => 'pre_keys',
                        'type' => 'intermediate',
                        'installments' => 1,
                        'installment_value' => $proposal->unit->pre_keys_intermediate_value,
                        'start_date' => $proposal->unit->intermediate_start_6 ?? now(),
                        'proposal_id' => $proposal->id,
                    ]);
                }
            }
        }

        if ($proposal->unit->financing_monthly_qty > 0) {
            $payment = ProposalPayment::create([
                'section' => 'post_keys',
                'type' => 'monthly',
                'installments' => $proposal->unit->financing_monthly_qty,
                'installment_value' => $proposal->unit->financing_monthly_value,
                'start_date' => $proposal->unit->financing_monthly_start ?? now(),
                'proposal_id' => $proposal->id,
            ]);
        }

        if ($proposal->unit->financing_yearly_qty > 0) {
            $payment = ProposalPayment::create([
                'section' => 'post_keys',
                'type' => 'intermediate',
                'installments' => $proposal->unit->financing_yearly_qty,
                'installment_value' => $proposal->unit->financing_yearly_value,
                'start_date' => $proposal->unit->financing_yearly_start ?? now(),
                'proposal_id' => $proposal->id,
            ]);
        }
    }
}
