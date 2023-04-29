<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\ProgressReport;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function project_report()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $clients = Client::all();
        $projects = Project::all();
        return view('project_report', compact(['roles', 'clients', 'projects']));
    }
    public function filter_project(Request $request)
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $clients = Client::all();
        $projects = Project::all();

        if ($request->client_id !== 'all') {
            // DD('if ');
            $products = Product::where('client_id', $request->client_id)->get();
        } elseif ($request->project_id !== 'all') {
            // DD('elseif ');
            $products = Product::where('project_id', $request->project_id)->get();
        } else {
            // DD('yahi ');
            $products = Product::all();
        }
        // DD('bahar ');
        // return $products;
        return view('project_report', compact(['roles', 'products', 'clients', 'projects']));
    }
    public function project_status($id)
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);
        // $progressreports = ProgressReport::all();
        $progressreports = ProgressReport::where('product_id', $id)->get();
        $filteredPercentage = $progressreports->where('is_completed', 'N');
        $allLength = count($progressreports);
        $length = count($filteredPercentage);
        if ($allLength > 0) {

            $calculatedPercentage = ($length / $allLength) * 100;
        } else {
            $calculatedPercentage = 0;
        }
        // return  $calculatedPercentage;
        return view('project_status', compact(['products', 'roles', 'progressreports', 'calculatedPercentage']));
    }
    public function post_status(Request $request)
    {
        $product_id = $request->input('product_id');
        $phase_names = $request->input('phase_name');
        $data = [];
        foreach ($phase_names as $phase_name) {
            $data[] = [
                'product_id' => $product_id,
                'phase_name' => $phase_name
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
}
