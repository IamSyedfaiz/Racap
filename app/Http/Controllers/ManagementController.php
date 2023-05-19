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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

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
        $data->brand_name = $request->brand_name;
        $data->product_name = $request->product_name;
        $data->modal_number = $request->modal_number;
        $data->client_id = $request->client_id;
        $data->factory_id = $request->factory_id;
        $data->project_id = $request->project_id;
        $data->user_id = auth()->user()->id;

        $data->save();
        return redirect()->back()->with('success', 'Add Product Successfully');
    }


    public function create_user()
    {
        // if (auth()->user()) {
        $users = User::where('parent_id', auth()->user()->id)->get();
        return view('create_user', compact('users'));
        // }
        // return redirect('login');
    }
    // public function create_client_user(Request $request)
    // {
    //     if (User::where('email', $request->client_email)->exists()) {
    //         $request->validate([
    //             'client_email' => 'required|unique:users,email',
    //             'client_password' => 'required',

    //         ]);
    //     } else {
    //         $request->validate([
    //             'client_mobile_number' => 'nullable|digits:10',
    //             'client_mobile_number.max' => 'Please enter a valid 10-digit mobile number',
    //             'client_landline_number' => 'nullable|digits:10',
    //             'client_landline_number.max' => 'Please enter a valid 10-digit mobile number',
    //         ]);
    //         $data = new User;
    //         $data->name = $request->user_name;
    //         $data->email  = $request->client_email;
    //         $data->mobile_number  = $request->client_mobile_number;
    //         $data->landline_number  = $request->client_landline_number;
    //         $data->password = Hash::make($request->client_password);
    //         // $data->password = $request->client_password;
    //         $data->parent_id = auth()->user()->id;
    //         $data->assignRole(Roles::CLIENT()->getValue());
    //         $data->save();
    //     }
    //     // return $request;

    //     return redirect()->back()->with('success', 'Add Client Successfully');
    // }

    public function create_client_user(Request $request)
    {
        if (User::where('email', $request->client_email)->exists()) {
            $request->validate([
                'client_email' => 'required|unique:users,email',
            ]);
        } else {
            $request->validate([
                'client_mobile_number' => 'nullable|digits:10',
                'client_mobile_number.max' => 'Please enter a valid 10-digit mobile number',
                'client_landline_number' => 'nullable|digits:10',
                'client_landline_number.max' => 'Please enter a valid 10-digit mobile number',
            ]);
            $password = rand(10000000,  100000000);

            $data = new User;
            $data->name = $request->user_name;
            $data->email  = $request->client_email;
            $data->password = bcrypt($password);
            $data->mobile_number  = $request->client_mobile_number;
            $data->landline_number  = $request->client_landline_number;
            // $data->password = $request->client_password;
            $data->parent_id = auth()->user()->id;
            $data->assignRole(Roles::CLIENT()->getValue());
            $data->save();

            $data = [
                'name' => $request->user_name,
                'email' => $request->client_email,
                'password' => $password,
                'link'      => url('/') . '/login'
            ];

            Mail::send('email.email_info', @$data, function ($msg) use ($data, $request) {
                $msg->from('racap@omegawebdemo.com.au');
                $msg->to($request->client_email, 'RACAP');
                $msg->subject('User Registration');
            });
        }
        // return $request;

        return redirect()->back()->with('success', 'Add Client Successfully');
    }
    public function create_consultant_user(Request $request)
    {
        if (User::where('email', $request->consultant_email)->exists()) {
            $request->validate([
                'consultant_email' => 'required|unique:users,email',
            ]);
        } else {
            $request->validate([
                'consultant_mobile_number' => 'nullable|digits:10',
                'consultant_mobile_number.max' => 'Please enter a valid 10-digit mobile number',
                'consultant_landline_number' => 'nullable|digits:10',
                'consultant_landline_number.max' => 'Please enter a valid 10-digit mobile number',
            ]);

            $password = rand(10000000,  100000000);

            $data = new User;
            $data->name = $request->user_name;
            $data->email  = $request->consultant_email;
            $data->password = bcrypt($password);
            $data->mobile_number  = $request->consultant_mobile_number;
            $data->landline_number  = $request->consultant_landline_number;
            // $data->password = $request->consultant_password;
            $data->parent_id = auth()->user()->id;
            $data->assignRole(Roles::CONSULTANT()->getValue());
            $data->save();




            $data = [
                'name' => $request->user_name,
                'email' => $request->consultant_email,
                'password' => $password,
                'link'      => url('/') . '/login'
            ];


            Mail::send('email.email_info', @$data, function ($msg) use ($data, $request) {
                $msg->from('racap@omegawebdemo.com.au');
                $msg->to($request->consultant_email, 'RACAP');
                $msg->subject('Title');
            });
        }
        // return $request;
        // return 1;

        return redirect()->back()->with('success', 'Add consultant Successfully');
    }
    public function add_client_project(Request $request)
    {
        $product_detail = new ProductDetail();
        $product_detail->user_id = $request->user_id;
        $product_detail->brand_id = $request->brand_id;
        $product_detail->client_id = $request->client_id;
        $product_detail->product_id = $request->product_id;
        $product_detail->project_id = $request->project_id;
        $product_detail->factory_id = $request->factory_id;

        $product_detail->parent_id = auth()->user()->id;
        $product_detail->type = 'CL';

        $product_detail->save();

        $product = Product::find($request->product_id);
        $user = User::find($request->user_id);
        $proejctName = $product->project->project_name;
        $productdetailClients = $product->productdetailClient;
        $productdetailConss = $product->productdetailCons;

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'type' => 'Client',
            'link'      => url('/') . '/login'
        ];

        Mail::send('email.email_info', @$data, function ($msg) use ($productdetailClients, $product, $productdetailConss, $proejctName) {
            $msg->from('racap@omegawebdemo.com.au');
            foreach ($productdetailConss as $productdetailCons) {
                $users = $productdetailCons->user->email;
                $msg->to($users, 'RACAP');
            }
            foreach ($productdetailClients as $productdetailClient) {
                $users = $productdetailClient->user->email;
                $msg->to($users, 'RACAP');
            }
            $msg->to($product->user->email, 'RACAP');

            $msg->subject('Project Allocation');
        });


        return redirect()->back()->with('success', 'Add Client Successfully');
    }
    public function add_consultant_project(Request $request)
    {

        // return $request->user_id;

        // $data = new User;
        // $data->name = $request->user_name;
        // $data->email  = $request->user_email;
        // $data->mobile_number  = $request->user_mobile_number;
        // $data->landline_number  = $request->user_landline_number;
        // $data->password = bcrypt('12345678');
        // $data->parent_id = auth()->user()->id;
        // $data->assignRole(Roles::CONSULTANT()->getValue());
        // $data->save();
        $product_detail = new ProductDetail();
        $product_detail->user_id = $request->user_id;
        $product_detail->client_id = $request->client_id;
        $product_detail->product_id = $request->product_id;
        $product_detail->project_id = $request->project_id;
        $product_detail->factory_id = $request->factory_id;
        $product_detail->parent_id = auth()->user()->id;
        $product_detail->type = 'CO';

        $product_detail->save();


        $product = Product::find($request->product_id);
        $user = User::find($request->user_id);
        $proejctName = $product->project->project_name;
        $productdetailClients = $product->productdetailClient;
        $productdetailConss = $product->productdetailCons;

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'type' => 'Consultant',
            'link'      => url('/') . '/login'
        ];

        Mail::send('email.email_info', @$data, function ($msg) use ($productdetailClients, $product, $productdetailConss, $proejctName) {
            $msg->from('racap@omegawebdemo.com.au');
            foreach ($productdetailConss as $productdetailCons) {
                $users = $productdetailCons->user->email;
                $msg->to($users, 'RACAP');
            }
            foreach ($productdetailClients as $productdetailClient) {
                $users = $productdetailClient->user->email;
                $msg->to($users, 'RACAP');
            }
            $msg->to($product->user->email, 'RACAP');

            $msg->subject('Project Allocation');
        });

        return redirect()->back()->with('success', 'Add Consultant Successfully');
    }
    public function user_delete($id)
    {
        $product = ProductDetail::where('user_id', $id)->first();
        $user = User::find($id);

        if ($product) {
            $product->delete();
            $user->delete();
        } else {

            $user->delete();
        }

        return redirect()->back()->with('danger', 'Teams Deleted');
    }
    public function changeActive($id, $active)
    {
        $user             = User::find($id);
        $user->active     = $active;
        $msg              = ($active == "Y") ? 'Suspended' :  'Activated';

        if ($user->save()) {
            return back()->with('success', 'User Account ' . $msg . ' Succesfully')->with('user', $user)->with('msg', $msg);
        } else {
            return back()->with('error', "Error Updating Client Profile")->with('user', $user)->with('msg', $msg);
        }
    }
}