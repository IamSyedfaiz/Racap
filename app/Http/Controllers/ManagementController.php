<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Roles;
use App\Models\Client;
use App\Models\Factory;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ManagementController extends Controller
{
    public function add_client(Request $request)
    {
        $input      = $request->all();
        Validator::make($input, [
            'client_name'    => ['required'],
        ])->validate();

        $data = new Client;
        $data->name = $request->client_name;
        $data->user_id = auth()->user()->id;
        $data->save();
        return redirect()->back()->with('success', 'Add Client Successfully');
    }
    public function add_factory(Request $request)
    {
        $input      = $request->all();
        Validator::make($input, [
            'factory_name'    => ['required'],
        ])->validate();

        $data = new Factory();
        $data->name = $request->factory_name;
        $data->client_id = $request->client_id;
        $data->user_id = auth()->user()->id;
        $data->save();
        return redirect()->back()->with('success', 'Add Factory Name Successfully');
    }

    public function add_project(Request $request)
    {
        $input      = $request->all();
        Validator::make($input, [
            'project_name'    => ['required', Rule::unique(Project::class),],
            'client_id'    => ['required'],


        ], [
            'project_name.unique' => 'Project Name Already Exist !',
            'client_id.required' => 'Please Select Client !'
        ])->validate();
        $data = new Project;
        $data->project_name = $request->project_name;
        $data->project_start_date = $request->project_start_date;
        $data->project_end_date = $request->project_end_date;
        $data->client_id = $request->client_id;
        $data->factory_id = $request->factory_id;
        $data->user_id = auth()->user()->id;

        $data->save();
        return redirect()->back()->with('success', 'Add Project Successfully');
    }

    public function add_product(Request $request)
    {
        $input      = $request->all();
        Validator::make($input, [
            'client_id'    => ['required'],
            'project_id'    => ['required'],


        ], [
            'client_id.required' => 'Please Select Client !',
            'project_id.required' => 'Please Select Project !'
        ])->validate();
        $data = new Product;
        $data->product_name = $request->product_name;
        $data->modal_number = $request->modal_number;
        $data->client_id = $request->client_id;
        $data->factory_id = $request->factory_id;
        $data->project_id = $request->project_id;
        $data->user_id = auth()->user()->id;

        $data->save();
        return redirect()->back()->with('success', 'Add Product Successfully');
    }
    public function add_client_project(Request $request)
    {
        $request->validate(
            ['user_mobile_number' => 'nullable|digits:10',],
            ['user_mobile_number.max' => 'Please enter a valid 10-digit mobile number',],
            ['user_landline_number' => 'nullable|digits:10',],
            ['user_landline_number.max' => 'Please enter a valid 10-digit mobile number',],
        );


        $data = new User;
        $data->name = $request->user_name;
        $data->email  = $request->user_email;
        $data->mobile_number  = $request->user_mobile_number;
        $data->landline_number  = $request->user_landline_number;
        $data->password = bcrypt('12345678');
        $data->parent_id = auth()->user()->id;
        $data->assignRole(Roles::CLIENT()->getValue());
        $data->save();
        $product_detail = new ProductDetail();
        $product_detail->user_id = $data->id;
        $product_detail->client_id = $request->client_id;
        $product_detail->product_id = $request->product_id;
        $product_detail->project_id = $request->project_id;
        $product_detail->factory_id = $request->factory_id;

        $product_detail->parent_id = auth()->user()->id;
        $product_detail->type = 'CL';

        $product_detail->save();


        return redirect()->back()->with('success', 'Add Client Successfully');
    }
    public function add_consultant_project(Request $request)
    {
        $request->validate(
            ['user_mobile_number' => 'nullable|digits:10',],
            ['user_mobile_number.max' => 'Please enter a valid 10-digit mobile number',],
            ['user_landline_number' => 'nullable|digits:10',],
            ['user_landline_number.max' => 'Please enter a valid 10-digit mobile number',],
        );
        $data = new User;
        $data->name = $request->user_name;
        $data->email  = $request->user_email;
        $data->mobile_number  = $request->user_mobile_number;
        $data->landline_number  = $request->user_landline_number;
        $data->password = bcrypt('12345678');
        $data->parent_id = auth()->user()->id;
        $data->assignRole(Roles::CONSULTANT()->getValue());
        $data->save();
        $product_detail = new ProductDetail();
        $product_detail->user_id = $data->id;
        $product_detail->client_id = $request->client_id;
        $product_detail->product_id = $request->product_id;
        $product_detail->project_id = $request->project_id;
        $product_detail->factory_id = $request->factory_id;
        $product_detail->parent_id = auth()->user()->id;
        $product_detail->type = 'CO';

        $product_detail->save();

        return redirect()->back()->with('success', 'Add Consultant Successfully');
    }
}