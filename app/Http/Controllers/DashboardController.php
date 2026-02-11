<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $despesas = auth()->user()->despesas()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('despesas'));
    }
}
