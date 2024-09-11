<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use App\Services\V1\Users\UsersServiceInterface;

class UsersController extends Controller
{
    //
    public function __construct(protected UsersServiceInterface $usersService)
    {
        // ...
    }
    public function index(Request $request): JsonResponse
    {
        return $this->usersService->list($request);
    }
}
