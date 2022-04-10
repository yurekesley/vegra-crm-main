<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use App\Models\UnitGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UnitGroupController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $filter_blocks = $request->query('filter_blocks');
        $filter_units = $request->query('filter_units');
        $selected_unit_group_id = $request->query('selected_unit_group_id');

        if (!empty($filter)) {
            $unitGroups = UnitGroup::sortable('number')
                ->where('product_id', $product->id)
                ->where('number', 'like', '%' . $filter_blocks . '%')
                ->paginate($pageSize);
        } else {
            $unitGroups = UnitGroup::sortable('number')
                ->where('product_id', $product->id)
                ->paginate($pageSize);
        }

        if ($selected_unit_group_id != null && $selected_unit_group_id > 0) {
            $unitGroup = UnitGroup::find($selected_unit_group_id);
            if (!empty($filter_units)) {
                $units = Unit::sortable('number')
                    ->where('product_id', $product->id)
                    ->where('unit_group_id', $unitGroup->id)
                    ->where('number', 'like', '%' . $filter_blocks . '%')
                    ->get();
            } else {
                $units = Unit::sortable('number')
                    ->where('product_id', $product->id)
                    ->where('unit_group_id', $unitGroup->id)
                    ->get();
            }
        } else {
            $unitGroup = null;
            if (!empty($filter_units)) {
                $units = Unit::sortable('number')
                    ->where('product_id', $product->id)
                    ->where('number', 'like', '%' . $filter_blocks . '%')
                    ->get();
            } else {
                $units = Unit::sortable('number')
                    ->where('product_id', $product->id)
                    ->get();
            }
        }

        return view('products.unit_groups.index')
            ->with('product', $product)
            ->with('unitGroups', $unitGroups)
            ->with('units', $units)
            ->with('filter_blocks', $filter_blocks)
            ->with('filter_units', $filter_units)
            ->with('unit_group', $unitGroup)
            ->with('selected_unit_group_id', $selected_unit_group_id)
            ->with('pageSize', $pageSize);
    }

    public function create(Product $product)
    {
        return view('products.unit_groups.create')
            ->with('product', $product);
    }

    public function store(Product $product, Request $request)
    {
        $request->validate([
            'type' => 'required|in:block,tower,village,square',
            'number' => [
                'required',
                'max:20',
                Rule::unique('unit_groups')->where('product_id', $product->id)->where('number', $request->number),
            ]
        ]);

        $unitGroup = UnitGroup::create([
            'type' => $request->type,
            'number' => $request->number,
            'product_id' => $product->id
        ]);

        Alert::success('Sucesso', $unitGroup->getTranslatedType() . ' criado com sucesso');

        return redirect()->route('products.unit_groups.index', $product->id);
    }

    public function edit(Product $product, UnitGroup $unit_group)
    {
        return view('products.unit_groups.edit')
            ->with('product', $product)
            ->with('unit_group', $unit_group);
    }

    public function update(Product $product, UnitGroup $unit_group, Request $request)
    {
        $request->validate([
            'number' => [
                'required',
                'max:20',
                Rule::unique('unit_groups')->where('product_id', $product->id)->where('number', $request->number),
            ]
        ]);

        $unit_group->number = $request->number;
        $unit_group->save();

        Alert::success('Sucesso', $unit_group->getTranslatedType() . ' atualizado com sucesso');

        return redirect()->route('products.unit_groups.index', $product->id);
    }

    public function destroy(Product $product, UnitGroup $unit_group)
    {
        $unit_group->delete();

        Alert::success('Sucesso', $unit_group->getTranslatedType() . ' removido com sucesso');

        return redirect()->route('products.unit_groups.index', $product->id);
    }
}
