<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Requests\Api\V1\Auth\Register\RegisterRequest;
use App\Repositories\V1\AuthRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @OA\Post(
     *      path="/auth/register",
     *      operationId="register",
     *      tags={"Registration"},
     *      summary="Register a new User",
     *      description="Register a new User",
     *     @OA\Parameter(
     *         name="X-Requested-With",
     *         in="header",
     *         description="Type XMLHttpRequest as value to this field",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *
     *         ),
     *         style="form"
     *     ),
     *     @OA\RequestBody(
     *      required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="role_id",
     *                     type="integer"
     *                 ),
     *                 example={
     *                          "name": "User Full Name",
     *                          "email": "user@email.com",
     *                          "role_id":2,
     *                          "password": "secret",
     *                          "password_confirmation":"secret"
     *                          }
     *             )
     *         )
     *     ),
     *      @OA\Response(response=201,description="Created"),
     *      @OA\Response(response=422, description="Unprocessable Entity"),
     *       @OA\Response(response=500, description="Unable to process request"),
     *     )
     *
     * Register a new User
     */
    public function register(RegisterRequest $r)
    {
        try {
            return $this->authRepository->register($r->validated());
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Unable to process request'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
