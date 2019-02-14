<?php

namespace App\Http\Controllers\Api\V1\Self;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/self/me",
     *      operationId="show",
     *      tags={"Self"},
     *      summary="Show currently logged in User's data",
     *      description="Show currently logged in User's data",
     *     @OA\Parameter(
     *         name="X-Requested-With",
     *         in="header",
     *         description="Type XMLHttpRequest as value to this field",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *         ),
     *         style="form"
     *     ),
     *      @OA\Response(response=200,description="Ok"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *      @OA\Response(response=500, description="Unable to process request"),
     *      security={{"api_key":{}}}
     * )
     *
     * Show currently logged in User's data
     */
    public function show()
    {
        try {
            return response()->json([Auth::user()], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Unable to process request'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
