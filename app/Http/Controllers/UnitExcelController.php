<?php

namespace App\Http\Controllers;

use App\Exports\UnitsExport;
use App\Imports\UnitsImport;
use App\Models\Product;
use App\Models\TempUnitImport;
use App\Models\Unit;
use App\Models\UnitGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class UnitExcelController extends Controller
{
    public function index(Product $product, Request $request)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $filter = $request->query('filter');

        $tempUnits = TempUnitImport::sortable('name')->where('product_id', $product->id)->paginate($pageSize);;
        return view('products.units.excel', compact('product', 'tempUnits'));
    }

    public function download(Product $product)
    {
        return Excel::download(new UnitsExport($product->id), 'unidades-' . $product->slug . '.xlsx');
    }

    public function upload(Product $product, Request $request)
    {
        TempUnitImport::where('product_id', $product->id)->delete();
        Excel::import(new UnitsImport($product->id), request()->file('units_spreadsheet'));

        $data = TempUnitImport::where('product_id', $product->id)->get();

        foreach ($data as $record) {
            $unit = Unit::where('product_id', $product->id)
                ->whereRelation('unit_group', 'type', $record->getTranslatedEnumType())
                ->whereRelation('unit_group', 'number', $record->type_number)
                ->where('number', $record->unit_number)
                ->first();

            if ($unit != null) {
                $record->status = 'updatable';
                $record->save();
            } else {
                $record->status = 'instertable';
                $record->save();
            }
        }

        return redirect()->route('products.units.excel', ['product' => $product->id]);
    }

    public function cancel(Product $product)
    {
        TempUnitImport::where('product_id', $product->id)->delete();

        return redirect()->route('products.unit_groups.index', ['product' => $product->id]);
    }

    public function confirm(Product $product, Request $request)
    {
        $data = TempUnitImport::where('product_id', $product->id)->get();

        foreach ($data as $record) {
            if ($record->status == 'updatable') {
                $unit = Unit::where('product_id', $product->id)
                    ->whereRelation('unit_group', 'type', $record->getTranslatedEnumType())
                    ->whereRelation('unit_group', 'number', $record->type_number)
                    ->where('number', $record->unit_number)
                    ->first();
            } else {
                $unit = new Unit();
                $unit->product_id = $product->id;
            }

            if ($unit->unit_group_id == null || $unit->unit_group_id == 0)
            {
                $unitGroup = UnitGroup::where('product_id', $product->id)
                    ->where('type', $record->getTranslatedEnumType())
                    ->where('number', $record->type_number)
                    ->first();

                if ($unitGroup == null)
                {
                    $unitGroup = UnitGroup::create([
                        'type' => $record->getTranslatedEnumType(),
                        'number' => $record->type_number,
                        'product_id' => $product->id
                    ]);
                }

                $unit->unit_group_id = $unitGroup->id;
            }

            $final_number = str_pad($record->unit_number, 10, "0", STR_PAD_LEFT);

            $unit->number = $record->unit_number;
            $unit->final_number = $final_number[strlen($final_number) - 1];
            $unit->size = $record->size;
            $unit->price = $record->price;
            $unit->sun = $record->getTranslatedEnumSun();
            $unit->floor = $record->floor;
            $unit->status = $record->getTranslatedUnitStatus();
            $unit->delivery_forecast = $record->delivery_forecast;
            $unit->has_pre_keys = $record->has_pre_keys;
            $unit->pre_keys_spot_month = $record->pre_keys_spot_month;
            $unit->inflow = $record->inflow;
            $unit->pre_keys_monthly_qty = $record->pre_keys_monthly_qty;
            $unit->pre_keys_monthly_value = $record->pre_keys_monthly_value;
            $unit->pre_keys_monthly_start = $record->pre_keys_monthly_start;
            $unit->pre_keys_intermediate_value = $record->pre_keys_intermediate_value;
            $unit->intermediate_start_1 = $record->intermediate_start_1;
            $unit->intermediate_start_2 = $record->intermediate_start_2;
            $unit->intermediate_start_3 = $record->intermediate_start_3;
            $unit->intermediate_start_4 = $record->intermediate_start_4;
            $unit->intermediate_start_5 = $record->intermediate_start_5;
            $unit->intermediate_start_6 = $record->intermediate_start_6;
            $unit->post_keys_financing_type = $record->getTranslatedFinancingTypeEnum();
            $unit->financing_monthly_qty = $record->financing_monthly_qty;
            $unit->financing_monthly_value = $record->financing_monthly_value;
            $unit->financing_monthly_start = $record->financing_monthly_start;
            $unit->financing_yearly_qty = $record->financing_yearly_qty;
            $unit->financing_yearly_value = $record->financing_yearly_value;
            $unit->financing_yearly_start = $record->financing_yearly_start;
            $unit->description = $record->description;

            $unit->save();
        }

        TempUnitImport::where('product_id', $product->id)->delete();

        Alert::success('Sucesso', 'Importação processada com sucesso');

        return redirect()->route('products.unit_groups.index', $product->id);
    }
}
