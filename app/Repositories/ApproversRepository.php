<?php

namespace App\Repositories;

use App\Models\Approvers;
use App\Repositories\Interfaces\ApproversInterface;

class ApproversRepository implements ApproversInterface
{
    

    public function storeApprovers($request)
    {
        return Approvers::create([
                'name'=>$request->name
            ]);
    }

    
}