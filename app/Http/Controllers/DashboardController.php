<?php

namespace App\Http\Controllers;

use App\Models\BoardMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dateTime = now();
        $messages = BoardMessage::where('start_date', '<=', $dateTime)
            ->where('end_date', '>=', $dateTime)
            ->where('active', true)
            ->get();

        return view('dashboard', compact('messages'));
    }
}
