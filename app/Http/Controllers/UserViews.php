<?php
#{{-----------------------------------------------------🙏अंतः अस्ति प्रारंभः🙏-----------------------------}}
namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\FormAttribute;
use App\Models\GroupType;
use App\Models\Message;
use App\Models\Wallet;
use App\Models\Master;
use App\Models\PricingDetail;
use App\Models\PurchaseService;
use App\Models\RegisterUser;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Session;
use Auth;
use Carbon\Carbon;
class UserViews extends Controller
{
    public function userloginpage()
    {
        return view('auth.UserPanel.login');
    }
    public function registration()
    {
        return view('auth.UserPanel.registration');
    }
    public function userdashboard()
    {
        return view('UserPanel.userdashboard');
    }
    public function logoutuserpanel()
    {
        Session::flush();
        Auth::guard('customer')->logout();
        return redirect()->route('userloginpage');
    }
    public function home()
    {
        $loggedinuser = Auth::guard('customer')->user();
        if (Auth::guard('customer')->check()) {
            $services = Master::where('type', '=', 'Services')->get();
            $consulting = Master::join('pricing_details', 'pricing_details.serviceid', '=', 'masters.id')
                ->select('pricing_details.price as price', 'masters.*')->where('type', '=', 'Consulting')->get();
            $debitTotal = 0;
            $creditTotal = 0;
            $creditTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'credit')->sum('amount');
            $debitTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'debit')->sum('amount');
            $walletamount = ($creditTotal - $debitTotal);
            return view('UserPanel.home', compact('services', 'consulting', 'walletamount'));
        } else {
            return redirect()->route('userloginpage');
        
        }
    }
    public function wallet()
    {
        $loggedinuser = Auth::guard('customer')->user();
        if (Auth::guard('customer')->check()) {
            $debitTotal = 0;
            $creditTotal = 0;
            $creditTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'credit')->sum('amount');
            $debitTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'debit')->sum('amount');
            $walletamount = ($creditTotal - $debitTotal);
            return view('UserPanel.wallet', compact('walletamount'));
        } else {
            return redirect()->route('userloginpage');
        }
    }
    public function servicedetail($id)
    {
        if (Auth::guard('customer')->check()) {
            $data = PricingDetail::join('masters', 'pricing_details.serviceid', '=', 'masters.id')
                ->select('masters.label as servicename', 'pricing_details.*')
                ->where('serviceid', $id)->first();
            // dd($data);
            return view('UserPanel.servicedetail', compact('data'));
        } else {
            return redirect()->route('userloginpage');
        }
    }
    public function userprofile()
    {
        if (Auth::guard('customer')->check()) {
            return view('UserPanel.userprofile');
        } else {
            return redirect()->route('userloginpage');
        }
    }
    public function editprofile()
    {
        if (Auth::guard('customer')->check()) {
            return view('UserPanel.editprofile');
        } else {
            return redirect()->route('userloginpage');
        }
    }
    public function allservices()
    {
        if (Auth::guard('customer')->check()) {
            $services = Master::where('type', '=', 'Services')->get();
            return view('UserPanel.allservices', compact('services'));
        } else {
            return redirect()->route('userloginpage');
        }
    }
    public function refer()
    {
        if (Auth::guard('customer')->check()) {
            return view('UserPanel.refer');
        } else {
            return redirect()->route('userloginpage');
        }
    }
    public function consultingdetails($id)
    {
        if (Auth::guard('customer')->check()) {
            $data = PricingDetail::join('masters', 'pricing_details.serviceid', '=', 'masters.id')
                ->select('masters.label as servicename', 'pricing_details.*')
                ->where('serviceid', $id)->first();
            // dd($data);
            return view('UserPanel.consultingdetail', compact('data'));
        } else {
            return redirect()->route('userloginpage');
        }
    }
    public function serviceformpage($id)
    {
        $loggedinuser = Auth::guard('customer')->user();
        $pricingdata = PricingDetail::join('masters', 'pricing_details.serviceid', '=', 'masters.id')
            ->select('masters.value as servicename', 'pricing_details.*')->
            where('serviceid', $id)->first();
        $serviceid = $id;
        $formattributes = FormAttribute::where('masterserviceid', $id)->get();

        $masterdata = Master::where('id', $id)->first();

        $debitTotal = 0;
        $creditTotal = 0;
        $creditTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'credit')->sum('amount');
        $debitTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'debit')->sum('amount');
        $walletamount = ($creditTotal - $debitTotal);
        return view('UserPanel.serviceformpage', compact('formattributes', 'serviceid', 'masterdata', 'pricingdata', 'walletamount'));
    }
    public function orderpage()
    {
        $loggedinuser = Auth::guard('customer')->user();
        $purchasedata = PurchaseService::join('masters', 'purchase_services.serviceid', '=', 'masters.id')
            ->select('masters.iconimage as iconimage', 'purchase_services.*')
            ->where('userid', $loggedinuser->id)->orderBy('created_at', 'Desc')->get();
        // dd( $purchasedata);
        return view('UserPanel.orderpage', compact('purchasedata'));
    }
    public function orderdetails($id)
    {
        $loggedinuser = Auth::guard('customer')->user();
        // Fetch purchased data
        $purchasedata = PurchaseService::join('masters', 'purchase_services.serviceid', '=', 'masters.id')
            ->select('masters.*', 'purchase_services.*')
            ->where('purchase_services.id', $id)
            ->first();

        // Decode JSON data
        $olddata = json_decode($purchasedata->formdata, true);
        // dd($olddata);

        $newformattributes = PurchaseService::join('form_attributes', 'form_attributes.masterserviceid', '=', 'purchase_services.serviceid')
            ->select('form_attributes.value as label', 'form_attributes.inputtype')
            ->where('purchase_services.id', $id)
            ->get()
            ->toArray();
        // dd($newformattributes);


        // Create a map of existing labels in $olddata for easy lookup
        $existingLabels = array_column($olddata, 'label');

        // Build the final JSON
        $finalData = $olddata;

        foreach ($newformattributes as $attribute) {
            if (!in_array($attribute['label'], $existingLabels)) {
                // Append missing attributes from $newformattributes
                $finalData[] = [
                    'label' => $attribute['label'],
                    'value' => '',
                    'type' => $attribute['inputtype'],
                ];
            }
        }

        // Convert the final data back to JSON
        $finalJson = json_encode($finalData);

        $debitTotal = 0;
        $creditTotal = 0;
        $creditTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'credit')->sum('amount');
        $debitTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'debit')->sum('amount');
        $walletamount = ($creditTotal - $debitTotal);
        return view('UserPanel.orderdetails', compact('purchasedata', 'finalJson', 'walletamount'));
    }

    public function proceedtopay($id){
        $loggedinuser = Auth::guard('customer')->user();
        $purchasedata = PurchaseService::join('masters', 'purchase_services.serviceid', '=', 'masters.id')
            ->select('masters.*', 'purchase_services.*')
            ->where('purchase_services.serviceid', $id)
            ->first();
        $debitTotal = 0;
        $creditTotal = 0;
        $creditTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'credit')->sum('amount');
        $debitTotal = Wallet::where('userid', $loggedinuser->id)->where('paymenttype', 'debit')->sum('amount');
        $walletamount = ($creditTotal - $debitTotal);
        return view('UserPanel.proceedtopay',compact('walletamount','purchasedata'));
    }

    public function allrefers(){
        $loggedinuser = Auth::guard('customer')->user();
        $myrefercode =  $loggedinuser->refercode;
        $list = RegisterUser::orderby('created_at','DESC')
        ->where(  'parentreferid' ,'=', $myrefercode)->get();
        $array = [];
        foreach ($list as $row) {
            $row->referral_count = RegisterUser::where('parentreferid', '=', $row->refercode)->count();
            $array[] = $row;
        }

        //dd($array);
        return view('UserPanel.allrefers',compact('list'));
    }

}