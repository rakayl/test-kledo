<?php

namespace App\Repositories;

use App\Models\ApprovalStages;
use App\Repositories\Interfaces\ApprovalStageInterface;

class ApprovalStageRepository implements ApprovalStageInterface
{
    public function getApprovalStage(){
        return ApprovalStages::all();
    }
    public function updateApprovalStage($request, $id){
        return ApprovalStages::where('id',$id)->update([
                'approver_id'=>$request->approver_id
            ]);
    }
    public function storeApprovalStage($request)
    {
        return ApprovalStages::create([
                'approver_id'=>$request->approver_id
            ]);
    }

    
}