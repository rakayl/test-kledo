<?php

namespace App\Repositories\Interfaces;

interface ApprovalStageInterface
{
    public function getApprovalStage();
    public function updateApprovalStage($request, $id); 
    public function storeApprovalStage($request);
}