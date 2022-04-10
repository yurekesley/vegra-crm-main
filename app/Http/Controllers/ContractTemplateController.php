<?php

namespace App\Http\Controllers;

use App\Models\ContractTemplate;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContractTemplateController extends Controller
{
    public function index(Request $request)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $templates = ContractTemplate::sortable('name')
                ->where('name', 'like', '%' . $filter . '%')
                ->orWhereHas('product', function($q) use ($filter) {
                    $q->where('name', 'like', '%' . $filter . '%');
                })
                ->paginate($pageSize);
        } else {
            $templates = ContractTemplate::sortable('name')
                ->paginate($pageSize);
        }

        return view('contract_templates.index')
            ->with('templates', $templates)
            ->with('filter', $filter);
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('contract_templates.create')
            ->with('products', $products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:contract_templates,name',
            'active' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);

        $template = ContractTemplate::create([
            'name' => $request->name,
            'active' => $request->active,
            'product_id' => $request->product_id,
            'content' => $request->content,
        ]);

        Alert::success('Sucesso', 'Minuta criada com sucesso');

        return redirect()->route('contract_templates.index');
    }

    public function edit(ContractTemplate $contractTemplate)
    {
        $products = Product::orderBy('name')->get();
        return view('contract_templates.edit')
            ->with('template', $contractTemplate)
            ->with('products', $products);
    }

    public function update(ContractTemplate $contractTemplate, Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:contract_templates,name,'.$contractTemplate->id,
            'active' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);

        $contractTemplate->name = $request->name;
        $contractTemplate->active = $request->active;
        $contractTemplate->product_id = $request->product_id;
        $contractTemplate->content = $request->content;

        $contractTemplate->save();

        Alert::success('Sucesso', 'Minuta alterada com sucesso');

        return redirect()->route('contract_templates.index');
    }

    public function destroy(ContractTemplate $contractTemplate)
    {
        $contractTemplate->delete();

        Alert::success('Sucesso', 'Minuta removida com sucesso');

        return redirect()->route('contract_templates.index');
    }
}
