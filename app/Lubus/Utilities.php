<?php

use App\Plan;
use App\Member;
use App\Setting;
use Carbon\Carbon;
use App\Subscription;
use Illuminate\Http\Request;

class Utilities
{
    public static function setActiveMenu($uri, $isParent = false)
    {
        $class = ($isParent) ? 'active open' : 'active';

        return \Request::is($uri) ? $class : '';
        //return \Request::is($uri);
    }

    // Get Setting
    public static function getSetting($key)
    {
        $settingValue = Setting::where('key', '=', $key)->pluck('value');

        return $settingValue;
    }

    //get Settings
    public static function getSettings()
    {
        $settings = Setting::all();
        $settings_array = [];

        foreach ($settings as $setting) {
            $settings_array[$setting->key] = $setting->value;
        }

        return $settings_array;
    }

    //Follow up Status
    public static function getFollowUpStatus($status)
    {
        switch ($status) {
        case '1':
            return 'Done';
            break;

        default:
            return 'Pending';
            break;
    }
    }

    //Follow up by
    public static function getFollowupBy($followUpBy)
    {
        switch ($followUpBy) {
        case '1':
            return 'SMS';
            break;

        case '2':
            return 'Personal';
            break;

        default:
            return 'Call';
            break;
    }
    }

    //FollowUp Status Icon bg
    public static function getIconBg($status)
    {
        switch ($status) {
        case '1':
            return 'bg-blue-400 border-blue-700';
            break;

        default:
            return 'bg-orange-400 border-orange-700';
            break;
    }
    }

    //Followup Status Icon
    public static function getStatusIcon($status)
    {
        switch ($status) {
        case '1':
            return 'fa fa-thumbs-up';
            break;

        default:
            return 'fa fa-refresh';
            break;
    }
    }

    // Aim for member & inquiry creation
    public static function getAim($aim)
    {
        switch ($aim) {
        case '1':
            return 'Networking';
            break;

        case '2':
            return 'Body Building';
            break;

        case '3':
            return 'Fatloss';
            break;

        case '4':
            return 'Weightgain';
            break;

        case '5':
            return 'Others';
            break;

        default:
            return 'Fitness';
            break;
    }
    }

    // Invoice Labels
    public static function getInvoiceLabel($status)
    {
        switch ($status) {
        case '0':
            return 'label label-danger';
            break;

        case '1':
            return 'label label-success';
            break;

        case '3':
            return 'label label-default';
            break;

        default:
            return 'label label-primary';
            break;
    }
    }

    //Paid Unpaid Labels
    public static function getPaidUnpaid($status)
    {
        switch ($status) {
        case '0':
            return 'label label-danger';
            break;

        default:
            return 'label label-primary';
            break;
    }
    }

    //Active-Inactive Labels
    public static function getActiveInactive($status)
    {
        switch ($status) {
        case '0':
            return 'label label-danger';
            break;

        default:
            return 'label label-primary';
            break;
    }
    }

    // Occupation of members
    public static function getOccupation($occupation)
    {
        switch ($occupation) {
        case '1':
            return 'Housewife';
            break;

        case '2':
            return 'Self Employed';
            break;

        case '3':
            return 'Professional';
            break;

        case '4':
            return 'Freelancer';
            break;

        case '5':
            return 'Others';
            break;

        default:
            return 'Student';
            break;
    }
    }

    // Source for member & inquiry creation
    public static function getSource($source)
    {
        switch ($source) {
        case '1':
            return 'Word of mouth';
            break;

        case '2':
            return 'Others';
            break;

        default:
            return 'Promotions';
            break;
    }
    }

    // Member Status
    public static function getStatusValue($status)
    {
        switch ($status) {
        case '0':
            return 'Inactive';
            break;

        case '2':
            return 'Archived';
            break;

        default:
            return 'Active';
            break;
    }
    }

    // Inquiry Status
    public static function getInquiryStatus($status)
    {
        switch ($status) {
        case '0':
            return 'Lost';
            break;

        case '2':
            return 'Member';
            break;

        default:
            return 'Lead';
            break;
    }
    }

    // Inquiry Label
    public static function getInquiryLabel($status)
    {
        switch ($status) {
        case '0':
            return 'label label-danger';
            break;

        case '2':
            return 'label label-success';
            break;

        default:
            return 'label label-primary';
            break;
    }
    }

    // Set invoice status
    public static function setInvoiceStatus($amount_due, $invoice_total)
    {
        if ($amount_due == 0) {
            $paymentStatus = \constPaymentStatus::Paid;
        } elseif ($amount_due > 0 && $amount_due < $invoice_total) {
            $paymentStatus = \constPaymentStatus::Partial;
        } elseif ($amount_due == $invoice_total) {
            $paymentStatus = \constPaymentStatus::Unpaid;
        } else {
            $paymentStatus = \constPaymentStatus::Overpaid;
        }

        return $paymentStatus;
    }

    // Invoice Status
    public static function getInvoiceStatus($status)
    {
        switch ($status) {
        case '1':
            return 'Paid';
            break;

        case '2':
            return 'Partial';
            break;

        case '3':
            return 'Overpaid';
            break;

        default:
            return 'Unpaid';
            break;
    }
    }

    // Subcription Status
    public static function getSubscriptionStatus($status)
    {
        switch ($status) {
        case '0':
            return 'Expired';
            break;

        case '2':
            return 'Renewed';
            break;

        case '3':
            return 'Cancelled';
            break;

        default:
            return 'OnGoing';
            break;
    }
    }

    // Subcription Label
    public static function getSubscriptionLabel($status)
    {
        switch ($status) {
        case '0':
            return 'label label-danger';
            break;

        case '2':
            return 'label label-success';
            break;

        case '3':
            return 'label label-default';
            break;

        default:
            return 'label label-primary';
            break;
    }
    }

    // Payment Mode
    public static function getPaymentMode($status)
    {
        switch ($status) {
        case '0':
            return 'Card';
            break;

        default:
            return 'Cash';
            break;
    }
    }


    // Get Gender
    public static function getGender($gender)
    {
        switch ($gender) {
        case 'm':
            return 'Male';
            break;

        case 'f':
            return 'Female';
            break;
    }
    }

    //Get invoice display name type
    public static function getDisplay($display)
    {
        switch ($display) {
        case 'gym_logo':
            return 'Gym Logo';
            break;

        default:
            return 'Gym Name';
            break;
    }
    }

    // Get Numbering mode
    public static function getMode($mode)
    {
        switch ($mode) {
        case '0':
            return 'Manual';
            break;

        default:
            return 'Automatic';
            break;
    }
    }

    public static function getGreeting()
    {
        //$time = date("H");
        $time = Carbon::now()->hour;
        /* If the time is less than 1200 hours, show good morning */
        if ($time < '12') {
            echo 'Good morning';
        } elseif /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    ($time >= '12' && $time < '17') {
            echo 'Good afternoon';
        } elseif /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    ($time >= '17' && $time < '22') {
            echo 'Good evening';
        } elseif /* Finally, show good night if the time is greater than or equal to 2200 hours */
    ($time >= '22') {
            echo 'Good night';
        }
    }

    /**
     *File Upload.
     **/
    public static function uploadFile(Request $request, $prefix, $recordId, $upload_field, $upload_path)
    {
        if ($request->hasFile($upload_field)) {
            $file = $request->file($upload_field);

            if ($file->isValid()) {
                File::delete(public_path('assets/img/gym/gym_logo.jpg'));
                $fileName = 'gym_logo.jpg';
                $destinationPath = public_path($upload_path);
                $request->file($upload_field)->move($destinationPath, $fileName);
                Image::make($destinationPath.'/'.$fileName)->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
            }
        }
    }

    public static function registrationsTrend()
    {
        // Get Financial date
        $startDate = new Carbon(Setting::where('key', '=', 'financial_start')->pluck('value'));
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            //$members = member::registrations($startDate->month,$startDate->year); // Laravel Scoped Query Issue: Workaroud Needed
            $members = Member::whereMonth('created_at', '=', $startDate->month)->whereYear('created_at', '=', $startDate->year)->count();
            $data[] = ['month' => $startDate->format('Y-m'), 'registrations' => $members];
            $startDate->addMonth();
        }

        return json_encode($data);
    }

    public static function membersPerPlan()
    {
        $data = [];

        $plans = Plan::onlyActive()->get();

        foreach ($plans as $plan) {
            $subscriptions = Subscription::where('status', '=', \constSubscription::onGoing)->where('plan_id', '=', $plan->id)->count();
            $data[] = ['label' =>$plan->plan_name, 'value'=>$subscriptions];
        }

        return json_encode($data);
    }

    // returns true, if domain is availible, false if not
    public static function isDomainAvailible($domain)
    {
        //check, if a valid url is provided
        if (! filter_var($domain, FILTER_VALIDATE_URL)) {
            return false;
        }

        //initialize curl
        $curlInit = curl_init($domain);
        curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlInit, CURLOPT_HEADER, true);
        curl_setopt($curlInit, CURLOPT_NOBODY, true);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        //get answer
        $response = curl_exec($curlInit);

        curl_close($curlInit);

        if ($response) {
            return true;
        }

        return false;
    }

}
