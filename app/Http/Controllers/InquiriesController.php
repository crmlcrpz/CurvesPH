<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Member;
use App\Inquiry;
use App\Followup;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $inquiries = Inquiry::indexQuery($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $inquiriesTotal = Inquiry::indexQuery($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->get();
        $count = $inquiriesTotal->count();

        if (! $request->has('drp_start') or ! $request->has('drp_end')) {
            $drp_placeholder = 'Select daterange filter';
        } else {
            $drp_placeholder = $request->drp_start.' - '.$request->drp_end;
        }

        $request->flash();

        return view('inquiries.index', compact('inquiries', 'count', 'drp_placeholder'));
    }

    public function show($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $followups = $inquiry->followups->sortByDesc('updated_at');

        return view('inquiries.show', compact('inquiry', 'followups'));
    }

    public function create()
    {
        return view('inquiries.create');
    }

    public function store(Request $request)
    {
        // unique values check
        $this->validate($request, ['email' => 'unique:inquiries,email',
                                'contact' => 'unique:inquiries,contact', ]);

        // Start Transaction
        DB::beginTransaction();

        try {
            // store inquiries details
            $inquiryData = ['name'=>$request->name,
                                    'DOB'=> $request->DOB,
                                    'gender'=> $request->gender,
                                    'contact'=> $request->contact,
                                    'email'=> $request->email,
                                    'address'=> $request->address,
                                    'status'=> \constInquiryStatus::Lead,
                                    'pin_code'=> $request->pin_code,
                                    'occupation'=> $request->occupation,
                                    'start_by'=> $request->start_by,
                                    'interested_in'=> implode(',', $request->interested_in),
                                    'aim'=> $request->aim,
                                    'source'=> $request->source, ];

            $inquiry = new Inquiry($inquiryData);
            $inquiry->createdBy()->associate(Auth::user());
            $inquiry->updatedBy()->associate(Auth::user());
            $inquiry->save();

            //Store the followup details
            $followupData = ['inquiry_id'=>$inquiry->id,
                                     'followup_by'=>$request->followup_by,
                                     'due_date'=>$request->due_date,
                                     'status'=> \constFollowUpStatus::Pending,
                                     'outcome'=>'', ];

            $followup = new Followup($followupData);
            $followup->createdBy()->associate(Auth::user());
            $followup->updatedBy()->associate(Auth::user());
            $followup->save();

            DB::commit();
            flash()->success('Inquiry was successfully created');

            return redirect(action('InquiriesController@show', ['id' => $inquiry->id]));
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error('Error while creating the Inquiry');

            return redirect(action('InquiriesController@index'));
        }
    }

    //End of store method

    public function edit($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        return view('inquiries.edit', compact('inquiry'));
    }

    public function update($id, Request $request)
    {
        $inquiry = Inquiry::findOrFail($id);

        $inquiry->name = $request->name;
        $inquiry->DOB = $request->DOB;
        $inquiry->gender = $request->gender;
        $inquiry->contact = $request->contact;
        $inquiry->email = $request->email;
        $inquiry->address = $request->address;
        $inquiry->pin_code = $request->pin_code;
        $inquiry->occupation = $request->occupation;
        $inquiry->start_by = $request->start_by;
        $inquiry->interested_in = implode(',', $request->interested_in);
        $inquiry->aim = $request->aim;
        $inquiry->source = $request->source;
        $inquiry->createdBy()->associate(Auth::user());
        $inquiry->updatedBy()->associate(Auth::user());
        $inquiry->update();

        flash()->success('Inquiry details were successfully updated');

        return redirect(action('InquiriesController@show', ['id' => $inquiry->id]));
    }

    public function lost($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $inquiry->status = \constInquiryStatus::Lost;
        $inquiry->updatedBy()->associate(Auth::user());
        $inquiry->update();

        flash()->success('Inquiry was marked as lost');

        return redirect('inquiries/all');
    }

    public function markMember($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $inquiry->status = \constInquiryStatus::Member;
        $inquiry->updatedBy()->associate(Auth::user());
        $inquiry->update();

        flash()->success('Inquiry was marked as member');

        return redirect('inquiries/all');
    }
}
