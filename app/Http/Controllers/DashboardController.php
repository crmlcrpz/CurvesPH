<?php

namespace App\Http\Controllers;

use Auth;
use App\Member;
use JavaScript;
use App\Inquiry;
use App\Setting;
use App\Followup;
use App\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        JavaScript::put([
            'jsRegistraionsCount' => \Utilities::registrationsTrend(),
            'jsMembersPerPlan' => \Utilities::membersPerPlan(),
        ]);

        $expirings = Subscription::dashboardExpiring()->paginate(5);
        $expiringTotal = Subscription::dashboardExpiring()->get();
        $expiringCount = $expiringTotal->count();
        $allExpired = Subscription::dashboardExpired()->paginate(5);
        $allExpiredTotal = Subscription::dashboardExpired()->get();
        $expiredCount = $allExpiredTotal->count();
        $birthdays = Member::birthday()->get();
        $birthdayCount = $birthdays->count();
        $recents = Member::recent()->get();
        $inquiries = Inquiry::onlyLeads()->get();
        $reminders = Followup::reminders()->get();
        $reminderCount = $reminders->count();
        $membersPerPlan = json_decode(\Utilities::membersPerPlan());

        return view('dashboard.index', compact('expirings', 'allExpired', 'birthdays', 'recents', 'inquiries', 'reminders', 'expiringCount', 'expiredCount', 'birthdayCount', 'reminderCount', 'membersPerPlan'));
    }

}
