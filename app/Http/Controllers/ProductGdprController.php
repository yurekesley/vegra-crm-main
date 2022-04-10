<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGdpr;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductGdprController extends Controller
{
    public function index(Product $product)
    {
        $customer = ProductGdpr::where('product_id', $product->id)->where('type', 'prospect')->first();
        $coparticipant = ProductGdpr::where('product_id', $product->id)->where('type', 'prospect_associate')->first();
        $proposal = ProductGdpr::where('product_id', $product->id)->where('type', 'proposal')->first();
        $legal_text = ProductGdpr::where('product_id', $product->id)->where('type', 'legal_text')->first();

        return view('products.gdpr.index')
            ->with('product', $product)
            ->with('customer', $customer)
            ->with('coparticipant', $coparticipant)
            ->with('proposal', $proposal)
            ->with('legal_text', $legal_text);
    }

    public function store(Product $product, Request $request)
    {
        $customer = ProductGdpr::where('product_id', $product->id)->where('type', 'prospect')->first();
        $coparticipant = ProductGdpr::where('product_id', $product->id)->where('type', 'prospect_associate')->first();
        $proposal = ProductGdpr::where('product_id', $product->id)->where('type', 'proposal')->first();
        $legal_text = ProductGdpr::where('product_id', $product->id)->where('type', 'legal_text')->first();

        if ($customer != null) {
            $customer->content = $request->customer;
            $customer->save();
        } else {
            $customer = ProductGdpr::create([
                'type' => 'prospect',
                'content' => $request->customer,
                'product_id' => $product->id
            ]);
        }

        if ($coparticipant != null) {
            $coparticipant->content = $request->coparticipant;
            $coparticipant->save();
        } else {
            $coparticipant = ProductGdpr::create([
                'type' => 'prospect_associate',
                'content' => $request->coparticipant,
                'product_id' => $product->id
            ]);
        }

        if ($proposal != null) {
            $proposal->content = $request->proposal;
            $proposal->save();
        } else {
            $proposal = ProductGdpr::create([
                'type' => 'proposal',
                'content' => $request->proposal,
                'product_id' => $product->id
            ]);
        }

        if ($legal_text != null) {
            $legal_text->content = $request->legal_text;
            $legal_text->save();
        } else {
            $legal_text = ProductGdpr::create([
                'type' => 'legal_text',
                'content' => $request->legal_text,
                'product_id' => $product->id
            ]);
        }

        Alert::success('Sucesso', 'Dados de LGPD do produto '.$product->name.' atualizados com sucesso');

        return redirect()->route('products.gdpr.index', $product->id);
    }
}
