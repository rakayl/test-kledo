<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ApprovalStages;
use App\Http\Requests\CreateApprovalStages;
use App\Http\Requests\UpdateApprovalStages;
use App\Repositories\Interfaces\ApprovalStageInterface;

class ApprovalStageController extends Controller
{
    private $data;
    public function __construct(ApprovalStageInterface $data)
    {
        $this->data = $data;
    }
    /**
     * @OA\get(
     *     path="/api/approval-stages",
     *     tags={"Approval-stages"},
     *     summary="Data approval stages",
     *     description="Create a new approval stages in the system",
     *     @OA\Response(
     *         response=200,
     *         description="approval stages successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error"
     *     )
     * )
     */
    public function index()
    {
         $db = $this->data->getApprovalStage();
            $response = array(
                'status'=>'Success',
                'result'=>$db
            );
            return response()->json($response, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/approval-stages",
     *     tags={"Approval-stages"},
     *     summary="Create a new approval stages",
     *     description="Create a new approval stages in the system",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"approver_id"},
     *             @OA\Property(property="approver_id", type="integer", example="1"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="approval stages created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error"
     *     )
     * )
     */
    public function store(CreateApprovalStages $request)
    {
        DB::beginTransaction();
        try {
            $db = $this->data->storeApprovalStage($request);
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
     * @OA\PUT(
     *     path="/api/approval-stages/{id}",
     *     tags={"Approval-stages-update"},
     *     summary="Update a approval stages",
     *     description="Update a approval stages in the system",
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
    public function update(UpdateApprovalStages $request, string $id)
    {
        DB::beginTransaction();
        try {
            $db = $this->data->updateApprovalStage($request, $id);
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

    
}
