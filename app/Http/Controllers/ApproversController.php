<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approvers;
use App\Http\Requests\CreateApprovers;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ApproversInterface;

class ApproversController extends Controller
{
    private $approversRepository;
    public function __construct(ApproversInterface $approversRepository)
    {
        $this->approversRepository = $approversRepository;
    }

    
    /**
     * @OA\Post(
     *     path="/api/approvers",
     *     tags={"Approvers"},
     *     summary="Create a new approvers",
     *     description="Create a new approvers in the system",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="approvers created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error"
     *     )
     * )
     */
    public function store(CreateApprovers $request)
    {
        DB::beginTransaction();
        try {
            $this->approversRepository->storeApprovers($request);
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
