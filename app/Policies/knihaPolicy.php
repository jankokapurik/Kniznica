<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Knihy;
use Illuminate\Auth\Access\HandlesAuthorization;

class knihaPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Knihy $kniha ) {

        return $user->id === $kniha->user_id;

    }
}