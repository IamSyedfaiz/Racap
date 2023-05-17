<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Roles;
use App\Models\Client;
use App\Models\Product;
use App\Models\ProgressReport;
use App\Models\Project;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function project_report()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();

        if ($roles === Roles::SUPER_ADMIN()->getValue()) {
            $clients = Client::all();
            $projects = Project::all();
        } elseif ($roles === Roles::SUB_ADMIN()->getValue()) {
            // DD('else');

            $clients = Client::where('user_id', auth()->user()->id)->get();
            $projects = Project::where('user_id', auth()->user()->id)->get();
        } else {
            $clients = Client::whereHas('productdetail', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
            // $projects = Project::all();
            $projects = Project::whereHas('productdetail', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
        }

        return view('project_report', compact(['roles', 'clients', 'projects']));
    }
    public function filter_project(Request $request)
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        // $clients = Client::all();



        if ($roles === Roles::SUPER_ADMIN()->getValue()) {
            $clients = Client::all();
            $projects = Project::all();
        } elseif ($roles === Roles::SUB_ADMIN()->getValue()) {
            // DD('else');

            $clients = Client::where('user_id', auth()->user()->id)->get();
            $projects = Project::where('user_id', auth()->user()->id)->get();
        } else {
            $clients = Client::whereHas('productdetail', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
            // $projects = Project::all();
            $projects = Project::whereHas('productdetail', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
        }
        // $clients = Client::whereHas('productdetail', function ($query) {
        //     $query->where('user_id', auth()->user()->id);
        // })->get();
        // // $projects = Project::all();
        // $projects = Project::whereHas('productdetail', function ($query) {
        //     $query->where('user_id', auth()->user()->id);
        // })->get();

        // if ($request->client_id !== 'all') {
        //     $products = Product::where('client_id', $request->client_id)->get();
        // } elseif ($request->project_id !== 'all') {
        //     $products = Product::where('project_id', $request->project_id)->get();
        // } else {
        //     $products = Product::all();
        // }

        // $products = Product::with('project_report')->get();

        $product = (new Product)->newQuery();
        if (!empty(request()->get('start_date'))) {
            $product->whereHas('project', function ($q) {
                $q->where('project_start_date', '=', request()->get('start_date'));
            });
        }
        if (!empty(request()->get('end_date'))) {
            $product->whereHas('project', function ($q) {
                $q->where('project_end_date', '=', request()->get('end_date'));
            });
        }

        if (!empty(request()->get('client_id'))) {
            $product->where('client_id', request()->get('client_id'));
        }

        if (!empty(request()->get('project_id'))) {
            $product->where('project_id', '=', request()->get('project_id'));
        }

        if (!empty(request()->get('status'))) {
            $product->with('project_report');
        }
        if ($roles === Roles::SUPER_ADMIN()->getValue()) {
            $products = $product->orderBy('id', 'ASC')->get();
        } elseif ($roles === Roles::SUB_ADMIN()->getValue()) {
            $products = $product->orderBy('id', 'ASC')->where('user_id', auth()->user()->id)->get();
        } else {
            $products = $product->whereHas('productdetail', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->orderBy('id', 'ASC')->get();
        }


        return view('project_report', compact(['roles', 'products', 'clients', 'projects']));
    }
    public function project_status($id)
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);
        $progressreports = ProgressReport::where('product_id', $id)->get();
        $filteredPercentage = $progressreports->where('is_completed', 'N');
        $filteredName = $progressreports->where('is_completed', 'N')->last();
        $allLength = count($progressreports);
        $length = count($filteredPercentage);
        if ($allLength > 0) {

            $calculatedPercentage = ($length / $allLength) * 100;
            $calculatedPercentage = intval($calculatedPercentage);
        } else {
            $calculatedPercentage = 0;
            $calculatedPercentage = intval($calculatedPercentage);
        }
        // return  $calculatedPercentage;
        return view('project_status', compact(['products', 'roles', 'progressreports', 'calculatedPercentage', 'filteredName']));
    }
    public function post_status(Request $request)
    {
        $product_id = $request->input('product_id');
        $phase_names = $request->input('phase_name');
        $data = [];
        foreach ($phase_names as $phase_name) {
            $data[] = [
                'product_id' => $product_id,
                'phase_name' => $phase_name,
                'created_at' => now(),
                'updated_at' => now(),

            ];
        }

        DB::table('progress_reports')->insert($data);

        return redirect()->back()->with('success', 'Successfully');
    }
    public function change_status($id)
    {
        $progressreport = ProgressReport::where('id', $id)->first();
        $progressreport->is_completed = 'N';

        $progressreport->save();


        // return response()->json($progressreport);
        return redirect()->back()->with('success', 'Successfully');
    }
    public function delete_status($id)
    {
        // return $id;
        $progressreports = ProgressReport::where('product_id', $id)->get();

        foreach ($progressreports as $progressreport) { // Check if the user record was found
            $progressreport->delete(); // Delete the user record
        }
        // $progressreport->delete();


        // return response()->json($progressreport);
        return redirect()->back()->with('success', 'Delete Successfully');
    }
    public function response_status(Request $request)
    {


        $res = Response::where('product_id', $request->product_id)->first();
        // return $res->id;
        if ($res) {
            $editRes = Response::find($res->id);
            $editRes->reply_under_process = $request->processyes ?? 'N';
            $editRes->awaited_reply_under_process = $request->awaited ?? 'N';
            $editRes->docs_verification_under_process = $request->docsverification ?? 'N';
            $editRes->info_awaited = $request->infoawaited ?? 'N';
            $editRes->save();
        } else {
            $data = new Response();
            $data->reply_under_process = $request->processyes ?? 'N';
            $data->awaited_reply_under_process = $request->awaited ?? 'N';
            $data->docs_verification_under_process = $request->docsverification ?? 'N';
            $data->info_awaited = $request->infoawaited ?? 'N';
            $data->product_id = $request->product_id;
            $data->save();
        }
        // $data = new Response();

        // $data->reply_under_process = $request->processyes;
        // $data->awaited_reply_under_process = $request->awaited;
        // $data->docs_verification_under_process = $request->docsverification;
        // $data->info_awaited = $request->infoawaited;
        // $data->product_id = $request->product_id;
        // $data->save();
        return redirect()->back()->with('success', 'Add Successfully');
    }
}