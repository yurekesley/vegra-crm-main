<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use App\Models\UnitGroup;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UnitController extends Controller
{
    public function create(Product $product)
    {
        $unitGroups = UnitGroup::where('product_id', $product->id)->get();
        return view('products.units.create')
            ->with('product', $product)
            ->with('unitGroups', $unitGroups);
    }

    public function store(Product $product, Request $request)
    {
        $request->validate([
            'unit_group_id' => 'required|numeric|exists:unit_groups,id',
            'size' => 'required|numeric',
            'number' => 'required|unique:units,number',
            'sun' => 'required|in:morning,afternoon,any',
            'price' => 'required|numeric',
            'floor' => 'required|numeric',
            'final_number' => 'required'
        ]);

        $unitGroup = UnitGroup::find($request->unit_group_id);

        $unit = Unit::create([
            'unit_group_id' => $request->unit_group_id,
            'product_id' => $product->id,
            'size' => $request->size,
            'number' => $request->number,
            'sun' => $request->sun,
            'price' => $request->price,
            'floor' => $request->floor,
            'final_number' => $request->final_number,
            'description' => $request->description,
            'parking_lots' => $request->parking_lots
        ]);

        Alert::success('Sucesso', 'Unidade criada com sucesso');

        return redirect()->route('products.unit_groups.index', $product->id);
    }

    public function edit(Product $product, Unit $unit)
    {
        $unitGroups = UnitGroup::where('product_id', $product->id)->get();
        return view('products.units.edit')
            ->with('product', $product)
            ->with('unit', $unit)
            ->with('unitGroups', $unitGroups);
    }

    public function update(Product $product, Unit $unit, Request $request)
    {
        $request->validate([
            'unit_group_id' => 'required|numeric|exists:unit_groups,id',
            'size' => 'required|numeric',
            'number' => 'required|unique:units,number,'.$unit->id,
            'sun' => 'required|in:morning,afternoon,any',
            'price' => 'required|numeric',
            'floor' => 'required|numeric',
            'final_number' => 'required'
        ]);

        $unit->unit_group_id = $request->unit_group_id;
        $unit->product_id = $product->id;
        $unit->size = $request->size;
        $unit->number = $request->number;
        $unit->sun = $request->sun;
        $unit->price = $request->price;
        $unit->floor = $request->floor;
        $unit->parking_lots = $request->parking_lots;
        $unit->final_number = $request->final_number;
        $unit->delivery_forecast = $request->delivery_forecast != null ? substr($request->delivery_forecast, 2, 4) . '-' . substr($request->delivery_forecast, 0, 2) . '-01' : null;
        $unit->has_pre_keys = $request->has_pre_keys;
        $unit->pre_keys_spot_month = $request->pre_keys_spot_month != null ? substr($request->pre_keys_spot_month, 2, 4) . '-' . substr($request->pre_keys_spot_month, 0, 2) . '-01' : null;
        $unit->inflow = $request->inflow;
        $unit->pre_keys_monthly_qty = $request->pre_keys_monthly_qty;
        $unit->pre_keys_monthly_value = $request->pre_keys_monthly_value;
        $unit->pre_keys_monthly_start = $request->pre_keys_monthly_start != null ? substr($request->pre_keys_monthly_start, 2, 4) . '-' . substr($request->pre_keys_monthly_start, 0, 2) . '-01' : null;
        $unit->pre_keys_intermediate_value = $request->pre_keys_intermediate_value;
        $unit->intermediate_start_1 = $request->intermediate_start_1 != null ? substr($request->intermediate_start_1, 2, 4) . '-' . substr($request->intermediate_start_1, 0, 2) . '-01' : null;
        $unit->intermediate_start_2 = $request->intermediate_start_2 != null ? substr($request->intermediate_start_2, 2, 4) . '-' . substr($request->intermediate_start_2, 0, 2) . '-01' : null;
        $unit->intermediate_start_3 = $request->intermediate_start_3 != null ? substr($request->intermediate_start_3, 2, 4) . '-' . substr($request->intermediate_start_3, 0, 2) . '-01' : null;
        $unit->intermediate_start_4 = $request->intermediate_start_4 != null ? substr($request->intermediate_start_4, 2, 4) . '-' . substr($request->intermediate_start_4, 0, 2) . '-01' : null;
        $unit->intermediate_start_5 = $request->intermediate_start_5 != null ? substr($request->intermediate_start_5, 2, 4) . '-' . substr($request->intermediate_start_5, 0, 2) . '-01' : null;
        $unit->intermediate_start_6 = $request->intermediate_start_6 != null ? substr($request->intermediate_start_6, 2, 4) . '-' . substr($request->intermediate_start_6, 0, 2) . '-01' : null;
        $unit->post_keys_financing_type = $request->post_keys_financing_type;
        $unit->financing_monthly_qty = $request->financing_monthly_qty;
        $unit->financing_monthly_value = $request->financing_monthly_value;
        $unit->financing_monthly_start = $request->financing_monthly_start != null ? substr($request->financing_monthly_start, 2, 4) . '-' . substr($request->financing_monthly_start, 0, 2) . '-01' : null;
        $unit->financing_yearly_qty = $request->financing_yearly_qty;
        $unit->financing_yearly_value = $request->financing_yearly_value;
        $unit->financing_yearly_start = $request->financing_yearly_start != null ? substr($request->financing_yearly_start, 2, 4) . '-' . substr($request->financing_yearly_start, 0, 2) . '-01' : null;
        $unit->description = $request->description;

        $unit->save();

        Alert::success('Sucesso', 'Unidade atualizada com sucesso');

        return redirect()->route('products.unit_groups.index', $product->id);
    }

    public function destroy(Product $product, Unit $unit)
    {
        $unit->delete();

        Alert::success('Sucesso', 'Unidade removida com sucesso');

        return redirect()->route('products.unit_groups.index', $product->id);
    }
}
