<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Roles;
use App\Models\Account;
use App\Models\CalenderAlert;
use App\Models\Conversation;
use App\Models\HistoryGetting;
use App\Models\Product;
use App\Models\ProgressReport;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\Trash;
use App\Models\UploadFile;
use App\Models\User;
use Carbon\Carbon;
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
        // foreach ($products as $product) {
        //     if ($product->project->project_start_date <= $currentDate && $product->project->project_end_date >= $currentDate) {
        //         $progressreports = ProgressReport::where('product_id', $product->id)->get();
        //         $filteredPercentage = $progressreports->where('is_completed', 'N');
        //         $filteredName = $progressreports->where('is_completed', 'N')->last();
        //         $allLength = count($progressreports);
        //         $length = count($filteredPercentage);
        //         if ($allLength > 0) {

        //             $calculatedPercentage = ($length / $allLength) * 100;
        //             $calculatedPercentage = intval($calculatedPercentage);
        //         } else {
        //             $calculatedPercentage = 0;
        //             $calculatedPercentage = intval($calculatedPercentage);
        //         }
        //         $latestEntry = HistoryGetting::where('product_id', $product->id)
        //             ->orderBy('created_at', 'desc')
        //             ->first();
        //     }
        // }


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
        $latestEntry = HistoryGetting::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('project-details', compact(['products', 'roles', 'conversations', 'progressreports', 'calculatedPercentage', 'filteredName', 'latestEntry']));
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
        $latestEntry = HistoryGetting::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
        return view('files', compact(['products', 'upload_files', 'roles', 'calculatedPercentage', 'filteredName', 'latestEntry']));
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

        $proejctName = $product->project->project_name;
        $modalNumber = $product->modal_number;

        $productdetailClients = $product->productdetailClient;


        $productdetailConss = $product->productdetailCons;

        $fileName =  @$data->getMedia('post_image')->first()->file_name;
        $dataWith = [
            // 'text1' => 'Subject: Ledger Update - ' . $proejctName,
            'text2' => 'File Name: ' . $fileName . ', uploaded for project: ' . $proejctName . ', Model:' . $modalNumber,
            'text3' => 'Kindly login to view the file.',
            'link'      => url('/') . '/login'
        ];

        Mail::send('email.data_info', @$dataWith, function ($msg) use ($productdetailClients, $product, $productdetailConss, $proejctName) {
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

            $msg->subject('Subject: File Upload - ' . $proejctName);
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
        $latestEntry = HistoryGetting::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
        return view('view_account', compact(['products', 'roles', 'accounts', 'calculatedPercentage', 'filteredName', 'latestEntry']));
    }
    public function view_trash($id)
    {
        // $products = Product::find($id);

        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        $products = Product::find($id);
        // $trashs = Trash::all();
        // $trashs = UploadFile::onlyTrashed()->get();
        $trashs = UploadFile::onlyTrashed()->where('product_id', $id)->get();

        // $trashs = UploadFile::where('product_id', $id)->get();
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
        $latestEntry = HistoryGetting::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
        return view('view_trash', compact(['products', 'roles', 'trashs', 'calculatedPercentage', 'filteredName', 'latestEntry']));
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
        $proejctName = $product->project->project_name;
        $productdetailClients = $product->productdetailClient;
        $productdetailConss = $product->productdetailCons;
        // return $proejctName;
        $dataWith = [
            'text1' => 'Message: ' . auth()->user()->name . ' has updated ledger,',
            'text2' => '' . $request->invoice_payment . ' Raised  ' . $request->balance . ',' . $request->remark,
            // 'text3' => 'This amount is added',
            'link'      => url('/') . '/login'
        ];

        Mail::send('email.data_info', @$dataWith, function ($msg) use ($productdetailClients, $product, $productdetailConss, $proejctName) {
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

            $msg->subject('Subject: Ledger Update - ' . $proejctName);
        });


        return redirect()->back();
    }
    public function fileDelete($id, $product_id)
    {

        // DD($product_id);

        $product = Product::find($product_id);
        $proejctName = $product->project->project_name;
        $productdetailClients = $product->productdetailClient;
        $productdetailConss = $product->productdetailCons;
        // return $proejctName;
        $dataWith = [
            'text1' => 'A file has been moved to trash under ' . $proejctName,
            'link'      => url('/') . '/login'
        ];

        Mail::send('email.data_info', @$dataWith, function ($msg) use ($productdetailClients, $product, $productdetailConss, $proejctName) {
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

            $msg->subject('File moved to trash - ' . $proejctName);
        });
        // die;
        // Get the product with the specified ID
        $uploadFile = UploadFile::where('id', $id)->first();

        $uploadFile->deleted_by = auth()->user()->id;
        $uploadFile->save();
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
        $password = rand(10000000,  100000000);

        $data = [
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => $password,
            'link'      => url('/') . '/login'
        ];


        Mail::send('email.email_info', @$data, function ($msg) use ($data, $request) {
            $msg->from('racap@omegawebdemo.com.au');
            $msg->to($request->user_email, 'RACAP');
            $msg->subject('User Registration');
        });

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
        $history_gettings = HistoryGetting::where('product_id', $id)->latest('created_at')->get();
        $latestEntry = HistoryGetting::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
        // return $latestEntry;
        return view('history_getting', compact('roles', 'products', 'filteredName', 'history_gettings', 'calculatedPercentage', 'latestEntry'));
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
    public function alert_calender($id)
    {
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames()->first();

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
        $history_gettings = HistoryGetting::where('product_id', $id)->latest('created_at')->get();
        $latestEntry = HistoryGetting::where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        $calender_alerts = CalenderAlert::all();
        $current_date = now()->format('d-m-Y');
        $alert_date1 = '';
        $alert_date2 = '';
        $alert_date3 = '';
        foreach ($calender_alerts as $calender_alert) {
            $alert_date1 = Carbon::parse($calender_alert->alert_date1)->format('d-m-Y');
            $alert_date2 = Carbon::parse($calender_alert->alert_date2)->format('d-m-Y');
            $alert_date3 = Carbon::parse($calender_alert->alert_date3)->format('d-m-Y');
        }



        // return $alert_date1; 
        return view('alert_calender', compact('roles', 'calender_alerts', 'products', 'current_date', 'alert_date1', 'alert_date2', 'filteredName', 'history_gettings', 'calculatedPercentage', 'latestEntry'));
    }
    public function store_alert_calender(Request $request)
    {
        $data = new CalenderAlert();
        $data->user_id = auth()->user()->id;
        $data->product_id = $request->product_id;
        $data->particular = $request->particular;
        $data->renew_date = $request->renew_date;
        $data->alert_date1 = $request->alert_date1;
        $data->alert_date2 = $request->alert_date2;
        $data->alert_date3 = $request->alert_date3;
        $data->alert_note = $request->alert_note;
        $data->save();
        return redirect()->back();
    }

    public function delete_alert_calender($id)
    {
        $alert_calender = CalenderAlert::find($id);
        $alert_calender->delete();
        return redirect()->back();
    }
}
