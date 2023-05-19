<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Roles;
use App\Models\Account;
use App\Models\Conversation;
use App\Models\HistoryGetting;
use App\Models\Product;
use App\Models\ProgressReport;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\Trash;
use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $user = auth()->user();

        if ($user->active == 'Y') {
            // return 1;
            Auth::logout();
            return redirect()->back()->with('danger', 'Your Account has been Suspended');
        } else {

            // $user = auth()->user();
            $roles = $user->getRoleNames()->first();
            $start_date = '';
            $current_project = '';
            $past_project = '';

            if ($roles === Roles::SUPER_ADMIN()->getValue()) {
                $currentDate = now();
                $start_date = Project::where('project_start_date', '<=', $currentDate)->where('user_id', auth()->user()->id)->get();
                $current_project = Product::whereHas('project', function ($q) use ($currentDate) {
                    $q->where('project_start_date', '<=', $currentDate)->where('project_end_date', '>=', $currentDate);
                })->get();
                $upcoming_project = Project::where('project_start_date', '>', $currentDate)->get();
                $past_project = Project::where('project_end_date', '<', $currentDate)->get();
            } elseif ($roles === Roles::SUB_ADMIN()->getValue()) {
                $currentDate = now();
                $start_date = Project::where('project_start_date', '<=', $currentDate)->where('user_id', auth()->user()->id)->get();
                $current_project = Product::whereHas('project', function ($q) use ($currentDate) {
                    $q->where('project_start_date', '<=', $currentDate)->where('project_end_date', '>=', $currentDate);
                })->get();
                $upcoming_project = Project::where('project_start_date', '>', $currentDate)->get();
                $past_project = Project::where('project_end_date', '<', $currentDate)->get();
            } else {
                $currentDate = now();
                $start_date = Project::where('project_start_date', '<=', $currentDate)->where('user_id', auth()->user()->id)->get();
                $current_project = Product::whereHas('project', function ($q) use ($currentDate) {
                    $q->where('project_start_date', '<=', $currentDate)->where('project_end_date', '>=', $currentDate);
                })->get();
                $upcoming_project = Project::where('project_start_date', '>', $currentDate)->get();
                // $upcoming_project = Product::whereHas('productdetail', function ($q) use ($currentDate) {
                //     $q->where('project_start_date', '>', $currentDate)->where('user_id', auth()->user()->id);
                // })->get();
                $past_project = Project::where('project_end_date', '<', $currentDate)->get();
            }


            return view('dashboard', compact(['roles', 'past_project', 'upcoming_project', 'current_project', 'user']));
        }
    }

    public function currentprojects()
    {

        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $products = '';
        if ($roles === Roles::SUPER_ADMIN()->getValue()) {
            $products = Product::all();
        } elseif ($roles === Roles::SUB_ADMIN()->getValue()) {

            $products = Product::where('user_id', auth()->user()->id)->get();
        } else {

            $products = Product::whereHas('productdetail', function ($q) use ($user) {
                $q->where('user_id', '=', $user->id);
            })->get();
        }
        $currentDate = now();
        // DD($products->toArray());
        // $current_project = Project::where('project_start_date', 'tpday')->get();
        // return $current_project;
        // return $currentDate;

        return view('currentprojects', compact(['products', 'roles', 'currentDate']));
    }
    public function project_details($id)
    {
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);
        $conversations = Conversation::where('product_id', $id)->get();
        $progressreports = ProgressReport::where('product_id', $id)->get();
        $filteredName = $progressreports->where('is_completed', 'N')->last();
        $filteredPercentage = $progressreports->where('is_completed', 'N');
        $allLength = count($progressreports);
        $length = count($filteredPercentage);
        if ($allLength > 0) {

            $calculatedPercentage = ($length / $allLength) * 100;
            $calculatedPercentage = intval($calculatedPercentage);
        } else {
            $calculatedPercentage = 0;
            $calculatedPercentage = intval($calculatedPercentage);
        }

        return view('project-details', compact(['products', 'roles', 'conversations', 'progressreports', 'calculatedPercentage', 'filteredName']));
    }
    public function view_files($id)
    {
        $products = Product::find($id);
        // return $products;
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();
        $upload_files = UploadFile::where('product_id', $id)->get();
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
        return view('files', compact(['products', 'upload_files', 'roles', 'calculatedPercentage', 'filteredName']));
    }

    public function upload_file(Request $request)
    {
        $data = new UploadFile;
        $data->addMediaFromRequest('file')->toMediaCollection('post_image');
        $data->file_subject = $request->file_subject;
        $data->remark = $request->remark;
        $data->section = $request->section;
        $data->product_id = $request->product_id;
        $data->user_id = auth()->user()->id;
        $data->save();

        $product = Product::find($request->product_id);

        $productdetailClients = $product->productdetailClient;


        $productdetailConss = $product->productdetailCons;


        // return $users;
        $fileName =  @$data->getMedia('post_image')->first()->file_name;
        $dataWith = [
            'text1' => 'Please Check ',
            'text2' => $fileName,
            'text3' => 'Add One File',
        ];

        Mail::send('email.data_info', @$dataWith, function ($msg) use ($productdetailClients, $product, $productdetailConss) {
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

            $msg->subject('Title');
        });

        return redirect()->back();
    }



    public function view_account($id)
    {




        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);

        $accounts = Account::where('product_id', $id)->get();

        $progressreports = ProgressReport::where('product_id', $id)->get();
        $filteredName = $progressreports->where('is_completed', 'N')->last();
        $filteredPercentage = $progressreports->where('is_completed', 'N');
        $allLength = count($progressreports);
        $length = count($filteredPercentage);
        if ($allLength > 0) {

            $calculatedPercentage = ($length / $allLength) * 100;
            $calculatedPercentage = intval($calculatedPercentage);
        } else {
            $calculatedPercentage = 0;
            $calculatedPercentage = intval($calculatedPercentage);
        }

        return view('view_account', compact(['products', 'roles', 'accounts', 'calculatedPercentage', 'filteredName']));
    }
    public function view_trash($id)
    {
        // $products = Product::find($id);

        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);
        // $trashs = Trash::all();
        $trashs = UploadFile::onlyTrashed()->get();
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
        return view('view_trash', compact(['products', 'roles', 'trashs', 'calculatedPercentage', 'filteredName']));
    }

    public function add_account(Request $request)
    {


        $last = Account::where('product_id', $request->product_id)->orderBy('created_at', 'desc')->first();

        $data = new Account;
        $data->date = $request->date;
        $data->particulars = $request->particulars;
        $data->invoice_payment = $request->invoice_payment;
        $data->remark = $request->remark;
        if ($last && $last->product_id == $request->product_id) {

            $last_balance = $last->available_balance;
            if ($last_balance) {
                $data->available_balance = $request->invoice_payment == 'IR' ? $last_balance + $request->balance : $last_balance - $request->balance;
            }
        } else {
            $data->available_balance = $request->balance;
        }
        $data->balance = $request->balance;
        $data->product_id = $request->product_id;
        $data->user_id = auth()->user()->id;
        $data->save();



        $product = Product::find($request->product_id);
        $productdetailClients = $product->productdetailClient;
        // return $product


        $productdetailConss = $product->productdetailCons;


        // return $users;
        $dataWith = [
            'text1' => $request->date,
            'text2' => $request->balance,
            'text3' => 'This amount is added',
        ];

        Mail::send('email.data_info', @$dataWith, function ($msg) use ($productdetailClients, $product, $productdetailConss) {
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

            $msg->subject('Title');
        });




        return redirect()->back();
    }
    public function fileDelete($id)
    {

        // DD($id);
        // die;
        // Get the product with the specified ID
        $uploadFile = UploadFile::where('id', $id)->first();

        // Delete the product
        $uploadFile->delete();
        // $data = new Trash;
        // $data->file_subject = $uploadFile->file_subject;
        // $data->remark = $uploadFile->remark;
        // $data->section = $uploadFile->section;
        // $data->product_id = $uploadFile->product_id;
        // $data->user_id = $uploadFile->user_id;
        // $data->save();
        return redirect()->back()->with('success', 'Move to Trash');
    }

    public function restore_file($id)
    {
        // $trashs = Trash::findOrFail($id);
        // $trashs->delete();

        // $data = new UploadFile;
        UploadFile::withTrashed()->find($id)->restore();
        // $data->file_subject = $trashs->file_subject;
        // $data->remark = $trashs->remark;
        // $data->section = $trashs->section;
        // $data->product_id = $trashs->product_id;
        // $data->user_id = $trashs->user_id;
        // $data->save();

        return redirect()->back()->with('success', 'Restore Form Trash');
    }
    public function final_delete($id)
    {


        $trash_delete = UploadFile::withTrashed()->find($id);
        // return $trash_delete;
        // $trash_delete = Trash::find($id);
        $trash_delete->forceDelete();

        return redirect()->back()->with('danger', 'Deleted Form Trash');
    }

    public function pastprojects()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $products = '';
        if ($roles === Roles::SUPER_ADMIN()->getValue()) {
            $products = Product::all();
        } elseif ($roles === Roles::SUB_ADMIN()->getValue()) {

            $products = Product::where('user_id', auth()->user()->id)->get();
        } else {

            $products = Product::whereHas('productdetail', function ($q) use ($user) {
                $q->where('user_id', '=', $user->id);
            })->get();
        }
        $currentDate = now();

        return view('past-project', compact(['products', 'roles', 'currentDate']));
    }

    public function upcomingproject()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $products = '';
        if ($roles === Roles::SUPER_ADMIN()->getValue()) {
            $products = Product::all();
        } elseif ($roles === Roles::SUB_ADMIN()->getValue()) {

            $products = Product::where('user_id', auth()->user()->id)->get();
        } else {

            $products = Product::whereHas('productdetail', function ($q) use ($user) {
                $q->where('user_id', '=', $user->id);
            })->get();
        }
        $currentDate = now();

        return view('upcoming-project', compact(['products', 'roles', 'currentDate']));
    }



    public function addsubadmin()
    {
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();
        $currentDate = now();
        $one_year = $currentDate->copy()->addYear();
        $two_year = $currentDate->copy()->addYears(2);
        $five_year = $currentDate->copy()->addYears(5);
        return view('add_subadmin', compact(['roles', 'one_year', 'two_year', 'five_year']));
    }

    public function add_subadmin(Request $request)
    {
        $data = new User;
        $data->name = $request->user_name;
        $data->email  = $request->user_email;
        $data->password = bcrypt('12345678');
        $data->parent_id = auth()->user()->id;
        $data->assignRole(Roles::SUB_ADMIN()->getValue());
        $data->save();
        $currentDate = now();
        $subcription = new Subscription();
        $subcription->user_id = $data->id;
        $subcription->amount = $request->amount;
        $subcription->start_date = $currentDate;
        $subcription->end_date = $request->expire_by;
        $subcription->save();

        return redirect()->back()->with('success', 'Create a Subadmin');
    }
    public function user_login(Request $request)
    {
        // return 1;
        // $user = User::find(auth()->user()->id);
        // if ($user->active == 'Y') {
        //     return redirect()->back()->with('success', 'Your Account has been Suspended');
        // } else {
        //     Auth::logout();
        //     return redirect('dashboard');
        // }
        // $user = User::find(Auth::user()->id);

        // if ($user->active == 'Y') {
        //     // return 1;
        //     Auth::logout();
        //     return redirect()->back()->with('success', 'Your Account has been Suspended');
        // } else {
        //     return 2;

        //     return redirect('dashboard');
        // }
    }
    public function historyGetting($id)
    {
        $progressreports = ProgressReport::where('product_id', $id)->get();
        $filteredName = $progressreports->where('is_completed', 'N')->last();
        $filteredPercentage = $progressreports->where('is_completed', 'N');
        $allLength = count($progressreports);
        $length = count($filteredPercentage);
        if ($allLength > 0) {

            $calculatedPercentage = ($length / $allLength) * 100;
            $calculatedPercentage = intval($calculatedPercentage);
        } else {
            $calculatedPercentage = 0;
            $calculatedPercentage = intval($calculatedPercentage);
        }
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);
        $history_gettings = HistoryGetting::all();
        return view('history_getting', compact('roles', 'products', 'history_gettings', 'calculatedPercentage'));
    }

    public function storeHistoryGetting(Request $request)
    {

        $data = new HistoryGetting;
        $data->product_id = $request->product_id;
        $data->user_id = auth()->user()->id;
        $data->getting_value = $request->getting_value;
        $data->reason = $request->reason;
        $data->save();

        return redirect()->back();
    }
}
