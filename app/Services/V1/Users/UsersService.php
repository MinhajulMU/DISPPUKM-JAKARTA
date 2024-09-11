<?php

namespace App\Services\V1\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;
use App\Repositories\V1\Users\UsersRepositoryInterface;
use App\Helpers\Response;

class UsersService implements UsersServiceInterface
{
    public function __construct(protected UsersRepositoryInterface $usersRepository)
    {
        // nothing
    }

    public function list(Request $request): JsonResponse
    {
        //
        $data = $this->usersRepository->getListUsers();
        return Response::success(data: $data);
    }
}
