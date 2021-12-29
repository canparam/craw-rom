<?php

namespace App\Services;

use App\Models\User;
use App\Services\Base\BaseRepository;

class UserService extends BaseRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }

}
