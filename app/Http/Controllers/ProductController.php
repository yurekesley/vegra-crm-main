<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\ImageManagerStatic as Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $products = Product::sortable('name')
                ->where('name', 'like', '%' . $filter . '%')
                ->orWhere('slug', 'like', '%' . $filter . '%')
                ->orWhere('email', 'like', '%' . $filter . '%')
                ->orWhere('phone', 'like', '%' . $filter . '%')
                ->paginate($pageSize);
        } else {
            $products = Product::sortable('name')
                ->paginate($pageSize);
        }

        return view('products.index')
            ->with('products', $products)
            ->with('filter', $filter)
            ->with('pageSize', $pageSize);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:products,email',
            'slug' => 'required|alpha_dash|unique:products,slug',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'show_for_customers' => false,
            'email' => $request->email,
            'slug' => $request->slug,
        ]);

        Alert::success('Sucesso', 'Produto criado com sucesso');

        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $fakeBroker = User::find($product->fake_broker_id);
        return view("products.edit", compact('product', 'fakeBroker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:products,email,' . $product->id,
            'slug' => 'required|alpha_dash|unique:products,slug,' . $product->id,
            'house_commission_value' => 'required|numeric|max:100',
            'partner_commission_value' => 'required|numeric|max:100',
            'commission_payer' => 'required|in:incorporator,customer',
            'show_commission_on_proposals' => 'required',
            'enable_prospects' => 'required',
            'sort_prospects' => 'required',
            'allow_customer_without_broker' => 'required',
            'allow_proposals' => 'required',
            'welcome_text' => 'nullable',
            'show_for_customers' => 'required',
            'qualification_text' => 'nullable',
            'logo' => 'sometimes|image|max:2048|mimes:jpg,jpeg,png',
            'fake_broker' => 'required_if:allow_customer_without_broker,true|nullable|email|max:100',
        ]);

        if ($request->hasFile('logo')) {
            // if ($product->logo_url != null)
            //     Storage::disk('s3')->

            $file = $request->file('logo');

            $img = Image::make($file);
            $img = $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img = $img->encode($file->getClientOriginalExtension());

            $name = $product->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'product-logos/' . $name;
            Storage::disk('s3')->put($filePath, $img, 'public');
            $path = Storage::disk('s3')->url($filePath);
            $product->logo_url = $path;
        }

        $product->name = $request->name;
        $product->email = $request->email;
        $product->phone = $request->phone;
        $product->house_commission_value = $request->house_commission_value;
        $product->partner_commission_value = $request->partner_commission_value;
        $product->commission_payer = $request->commission_payer;
        $product->show_commission_on_proposals = $request->show_commission_on_proposals;
        $product->enable_prospects = $request->enable_prospects;
        $product->sort_prospects = $request->sort_prospects;
        $product->allow_customer_without_broker = $request->allow_customer_without_broker;
        $product->allow_proposals = $request->allow_proposals;
        $product->welcome_text = $request->welcome_text;
        $product->qualification_text = $request->qualification_text;
        $product->show_for_customers = $request->show_for_customers;

        if ($request->allow_customer_without_broker == 'true') {
            $fakeBroker = User::where('email', $request->fake_broker)->where('user_status', 'active')->first();

            if ($fakeBroker == null) {
                Alert::error('Falha', 'Email de corretor geral inválido. Informe o email de um usuário existente.');
                throw ValidationException::withMessages(['fake_broker' => __('Corretor não encontrado ou inativo.')]);
            }

            $product->fake_broker_id = $fakeBroker->id;
        } else {
            $product->fake_broker_id = null;
        }

        $product->save();

        Alert::success('Sucesso', 'Produto alterado com sucesso');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        Alert::success('Sucesso', 'Produto removido com sucesso');

        return redirect()->route('products.index');
    }
}
