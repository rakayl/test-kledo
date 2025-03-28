<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApproversController;
use App\Http\Controllers\ApprovalStageController;
use App\Http\Controllers\ExpensesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('approvers', [ApproversController::class,'store']);


Route::get('approval-stages', [ApprovalStageController::class,'index']);
Route::post('approval-stages', [ApprovalStageController::class,'store']);
Route::put('approval-stages/{id}', [ApprovalStageController::class,'update']);


Route::get('expense', [ExpensesController::class,'index']);
Route::post('expense', [ExpensesController::class,'store']);
Route::patch('expense/{id}/approve', [ExpensesController::class,'approve']);
Route::get('expense/{id}', [ExpensesController::class,'show']);