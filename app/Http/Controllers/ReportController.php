<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function project_report()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $clients = Client::all();
        return view('project_report', compact(['roles', 'clients']));
    }
    public function filter_project(Request $request)
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $clients = Client::all();
        if ($request->client_id !== 'all') {

            $products = Product::where('client_id', $request->client_id)->get();
        } else {
            $products = Product::all();
        }
        // return $products;
        return view('project_report', compact(['roles', 'products', 'clients']));
    }
}
