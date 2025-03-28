<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovalStages extends Model
{
    protected $fillable = [
        'approver_id'
    ];
    protected $hidden = ['created_at','updated_at'];
}
