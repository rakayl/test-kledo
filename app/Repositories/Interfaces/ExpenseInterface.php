<?php

namespace App\Repositories\Interfaces;

interface ExpenseInterface
{
    public function getExpense();
    public function showExpense($id);
    public function patchExpense($request, $id); 
    public function storeExpense($request);
}