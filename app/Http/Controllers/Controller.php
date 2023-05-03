<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Factory;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function create_teams()
    {
        if (auth()->user()) {
            $users = User::where('parent_id', auth()->user()->id)->get();
            $clients = Client::where('user_id', auth()->user()->id)->get();
            $projects = Project::where('user_id', auth()->user()->id)->get();
            $products = Product::where('user_id', auth()->user()->id)->get();
            $factories = Factory::where('user_id', auth()->user()->id)->get();
            // $users = User::where('id', auth()->user()->id)->get();
        } else {
            return redirect('/login');
        }

        return view('create_teams', compact(['clients', 'projects', 'products', 'users', 'factories']));
    }
}
