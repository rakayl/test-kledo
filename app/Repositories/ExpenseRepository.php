<?php

namespace App\Repositories;

use App\Models\Expenses;
use App\Repositories\Interfaces\ExpenseInterface;
use App\Models\Approvals;
use App\Models\ApprovalStages;
use App\Models\Approvers;
use App\Models\Statuses;

class ExpenseRepository implements ExpenseInterface
{
    public function getExpense(){
        return Expenses::all();
    }
   
    public function patchExpense($request, $id){
       $status = Statuses::where('name','Menunggu Persetujuan')->first();
       $disetujui = Statuses::where('name','Disetujui')->first();
       $approval = Approvals::where([
           'expense_id'=>$id,
           'status_id'=>$status->id
       ])->first();
       if(isset($approval)){
           if($request->approver_id == $approval->approver_id){
               $approval->status_id = $disetujui->id;
               $approval->save();
               $cek = Approvals::where([
                            'expense_id'=>$id,
                            'status_id'=>$status->id
                        ])->count();
               if($cek == 0){
                   $expense = Expenses::where('id',$id)->update([
                       'status_id'=>$disetujui->id
                   ]);
               }
               return 'Approvers Success';
           }else{
              return 'Approvers invalid'; 
           }
       }else{
           return 'Expense telah disetujui';
       }
       
    }
    public function storeExpense($request)
    {
        $status = Statuses::where('name','Menunggu Persetujuan')->first();
        $db = Expenses::create([
                'amount'=>$request->amount,
                'status_id'=>$status->id
            ]);
        $approval_stage = ApprovalStages::orderby('id','ASC')->get();
         foreach($approval_stage as $value){
             $approval = Approvals::create([
                 'expense_id'=>$db->id,
                 'approver_id'=>$value->approver_id,
                 'status_id'=>$status->id,
             ]);
         }
         return $db;
    }

     public function showExpense($id){
        return Expenses::where('id',$id)->with(['status','approval','approval.approvers','approval.status'])->first();
    }
}