<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ################### Charts Methods #####################

    public function gymMemberCharts()
    {
        return view('reports.members.charts');
    }

    public function inquiryCharts()
    {
        return view('reports.inquiries.charts');
    }

    public function subscriptionCharts()
    {
        return view('reports.subscriptions.charts');
    }

    public function paymentCharts()
    {
        return view('reports.payments.charts');
    }

    public function invoiceCharts()
    {
        return view('reports.invoices.charts');
    }

    // ################ Data Methods #####################

    public function gymMemberData(Request $request)
    {
        return view('reports.members.data');
    }

    public function inquiryData()
    {
        return view('reports.inquiries.data');
    }

    public function subscriptionData()
    {
        return view('reports.subscriptions.data');
    }

    public function paymentData()
    {
        return view('reports.payments.data');
    }

    public function invoiceData()
    {
        return view('reports.invoices.data');
    }
}
