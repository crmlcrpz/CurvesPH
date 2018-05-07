<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    protected $table = 'inquiry_followups';

    protected $fillable = [
        'inquiry_id',
        'followup_by',
        'due_date',
        'status',
        'outcome',
        'created_by',
        'updated_by',
    ];

    protected $dates = ['created_at', 'updated_at', 'due_date'];

    public function Inquiry()
    {
        return $this->belongsTo('App\Inquiry', 'inquiry_id');
    }

    public function scopeReminders($query)
    {
        return $query->leftJoin('inquiries', 'inquiry_followups.inquiry_id', '=', 'inquiries.id')
                     ->select('inquiry_followups.*', 'inquiries.status')
                     ->where('inquiry_followups.due_date', '<=', Carbon::today())
                     ->where('inquiry_followups.status', '=', \constFollowUpStatus::Pending)
                     ->where('inquiries.status', '=', \constInquiryStatus::Lead);
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
