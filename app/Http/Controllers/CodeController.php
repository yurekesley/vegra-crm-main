<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCodeRequest;
use App\Models\Code;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $product_id = $request->product_id;

        if (!empty($product_id)) {
            $codes = Code::sortable('product.name')
                ->where('product_id', $product_id)
                ->paginate($pageSize);
        } else {
            $codes = Code::sortable('product.name')
                ->paginate($pageSize);
        }

        $products = Product::all();
        return view('codes.index', compact('codes', 'pageSize', 'products', 'product_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCodeRequest  $request
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        $request->validate([
            'available' => 'required|min:0'
        ]);

        $code->available = $request->available;
        $code->save();

        Alert::success('Sucesso', 'Quantidade disponível do código ' . $code->code . ' alterada com sucesso');

        return redirect()->route('codes.index', ['filter' => $request->query('filter')]);
    }
}
