<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approvals extends Model
{
    protected $fillable = [
        'expense_id',
        'approver_id',
        'status_id'
    ];
    protected $hidden = ['created_at','updated_at'];
    public function status()
    {
        return $this->belongsTo(Statuses::class, 'status_id');
    }
    public function approvers()
    {
        return $this->belongsTo(Approvers::class, 'approver_id');
    }
}
