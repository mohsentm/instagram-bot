<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use App\Services\ControllersService\Auth\UserRegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /** @var UserRegisterService  */
    private $registerService;

    /**
     * RegisterController constructor.
     * @param UserRegisterService $registerService
     */
    public function __construct(UserRegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     * @throws \App\Exceptions\RepositoryException
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        return Response()->json(
            $this->registerService->register($request->all()),
            Response::HTTP_CREATED
        );
    }
}
