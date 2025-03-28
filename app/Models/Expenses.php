<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
        'amount',
        'status_id'
    ];
    protected $hidden = ['created_at','updated_at'];
    
    public function status()
    {
        return $this->belongsTo(Statuses::class, 'status_id');
    }
    public function approval()
    {
        return $this->hasMany(Approvals::class, 'expense_id');
    }
    
}
