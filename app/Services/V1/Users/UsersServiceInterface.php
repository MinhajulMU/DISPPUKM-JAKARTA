<?php

namespace App\Services\V1\Users;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface UsersServiceInterface
{
    public function list(Request $request): JsonResponse;
}
