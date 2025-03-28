<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateExpenses;
use App\Models\Expenses;
use App\Repositories\Interfaces\ExpenseInterface;
use App\Http\Requests\ApproveExpense;

class ExpensesController extends Controller
{
    private $expenseRepository;
    public function __construct(ExpenseInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }
    /**
     * @OA\get(
     *     path="/api/expense",
     *     tags={"expense"},
     *     summary="Data expense ",
     *     description="Data expense",
     *     @OA\Response(
     *         response=200,
     *         description="expense successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error"
     *     )
     * )
     */
    public function index()
    {
         $db = $this->expenseRepository->getExpense();
            DB::commit();
            $response = array(
                'status'=>'Success',
                'result'=>$db
            );
            return response()->json($response, 200);
    }
    /**
     * @OA\Post(
     *     path="/api/expense",
     *     tags={"expense"},
     *     summary="Create a new expense ",
     *     description="Create a new expense  in the system",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount"},
     *             @OA\Property(property="amount", type="integer", example="1"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="expense  created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error"
     *     )
     * )
     */
    
    public function store(CreateExpenses $request)
    {
         DB::beginTransaction();
        try {
            
            $db = $this->expenseRepository->storeExpense($request);
            DB::commit();
            $response = array(
                'status'=>'Success',
                'result'=>$db
            );
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollback();
            $response = array(
                'status'=>'Failed',
                'message'=>$e->getMessage()
            );
            return response()->json($response, 500);
        }
    }
    
    /**
     * @OA\PATCH(
     *     path="/api/expense/{id}/approve",
     *     tags={"expense-approval"},
     *     summary="Expense approval",
     *     description="Expense approval in the system",
     *  @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true
     *      ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"approver_id"},
     *             @OA\Property(property="approver_id", type="integer", example="1"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="approval stages update successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error"
     *     )
     * )
     */
    public function approve(ApproveExpense $request, string $id)
    {
        DB::beginTransaction();
        try {
            $db = $this->expenseRepository->patchExpense($request, $id);
            DB::commit();
            $response = array(
                'status'=>'Success',
                'result'=>$db
            );
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollback();
            $response = array(
                'status'=>'Failed',
                'message'=>$e->getMessage()
            );
            return response()->json($response, 500);
        }
    }
    /**
     * @OA\GET(
     *     path="/api/expense/{id}",
     *     tags={"expense-detail"},
     *     summary="Expense detail",
     *     description="Expense detail in the system",
     *  @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="approval stages update successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $db = $this->expenseRepository->showExpense( $id);
            $response = array(
                'status'=>'Success',
                'result'=>$db
            );
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array(
                'status'=>'Failed',
                'message'=>$e->getMessage()
            );
            return response()->json($response, 500);
        }
    }
}
