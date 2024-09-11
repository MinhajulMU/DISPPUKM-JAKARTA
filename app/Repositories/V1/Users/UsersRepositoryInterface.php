<?php

namespace App\Repositories\V1\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface UsersRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @return Collection
     */
    public function getListUsers(): Collection;
}
