<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Roles;
use App\Models\Account;
use App\Models\Conversation;
use App\Models\Product;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\Trash;
use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $user = auth()->user();
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
            $past_project = Project::where('project_end_date', '<', $currentDate)->get();
        }


        return view('dashboard', compact(['roles', 'past_project', 'upcoming_project', 'current_project', 'user']));
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

        // return $receiver;
        return view('project-details', compact(['products', 'roles', 'conversations']));
    }
    public function view_files($id)
    {
        $products = Product::find($id);
        // return $products;
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();
        $upload_files = UploadFile::where('product_id', $id)->get();
        return view('files', compact(['products', 'upload_files', 'roles']));
    }

    public function upload_file(Request $request)
    {

        $data = new UploadFile;
        $data->addMediaFromRequest('file')->toMediaCollection();
        $data->file_subject = $request->file_subject;
        $data->remark = $request->remark;
        $data->section = $request->section;
        $data->product_id = $request->product_id;
        $data->user_id = auth()->user()->id;

        $data->save();
        return redirect()->back();
        // return view('files')->with('success', 'Upload File Successfully');


    }

    public function view_account($id)
    {
        // $products = Product::find($id);
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);
        //  return $id;
        // $accounts = Account::all();
        $accounts = Account::where('product_id', $id)->get();
        // return $accounts;
        return view('view_account', compact(['products', 'roles', 'accounts']));
    }
    public function view_trash($id)
    {
        // $products = Product::find($id);
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);
        $trashs = Trash::all();
        return view('view_trash', compact(['products', 'roles', 'trashs']));
    }

    public function add_account(Request $request)
    {


        $last = Account::latest()->limit(1)->first();

        $data = new Account;
        $data->date = $request->date;
        $data->particulars = $request->particulars;
        $data->invoice_payment = $request->invoice_payment;
        $data->remark = $request->remark;
        if ($last) {
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
        return redirect()->back();
    }
    public function fileDelete($id)
    {

        // DD($id);
        // Get the product with the specified ID
        $uploadFile = UploadFile::where('product_id', $id)->first();


        // Delete the product
        $uploadFile->delete();
        $data = new Trash;
        $data->file_subject = $uploadFile->file_subject;
        $data->remark = $uploadFile->remark;
        $data->section = $uploadFile->section;
        $data->product_id = $uploadFile->product_id;
        $data->user_id = $uploadFile->user_id;
        $data->save();
        return redirect()->back()->with('success', 'Move to Trash');
    }

    public function restore_file($id)
    {
        $trashs = Trash::findOrFail($id);
        $trashs->delete();

        $data = new UploadFile;
        $data->file_subject = $trashs->file_subject;
        $data->remark = $trashs->remark;
        $data->section = $trashs->section;
        $data->product_id = $trashs->product_id;
        $data->user_id = $trashs->user_id;
        $data->save();

        return redirect()->back()->with('success', 'Restore Form Trash');
    }

    public function final_delete($id)
    {

        $trash_delete = Trash::find($id);
        $trash_delete->delete();

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

    public function productdelete($id)
    {
        $products = Product::find($id);
        $products->delete();

        return redirect()->back()->with('danger', 'Teams Deleted');
    }

    public function addsubadmin()
    {
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();
        $currentDate = now();
        $one_year = $currentDate->copy()->addYear();
        $two_year = $currentDate->copy()->addYears(2);
        $five_year = $currentDate->copy()->addYears(5);
        // $five_year = $currentDate->addYear()->addYear();
        // return $two_year;
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
}
