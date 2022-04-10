<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use App\Models\UnitGroup;
use Illuminate\Http\Request;

class MirrorController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($request->product_id != null) {
            $unit_groups = UnitGroup::where('product_id', $request->product_id)->get();
            $unit_groups = $unit_groups->sortBy(function ($unitGroup, $key) {
                return $unitGroup->getTranslatedType() . $unitGroup->number;
            });
        } else {
            $unit_groups = [];
        }

        $products = Product::all();

        if ($product != null) {
            $free = Unit::where('product_id', $product->id)->where('status', 'free')->count();
            $booked = Unit::where('product_id', $product->id)->where('status', 'booked')->count();
            $sold = Unit::where('product_id', $product->id)->where('status', 'sold')->count();
        } else {
            $free = 0;
            $booked = 0;
            $sold = 0;
        }

        return view('mirrors.index')
            ->with('unit_groups', $unit_groups)
            ->with('products', $products)
            ->with('product', $product)
            ->with('free', $free)
            ->with('booked', $booked)
            ->with('sold', $sold);
    }
}
