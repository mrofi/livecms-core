<?php

namespace LiveCMS\Policies;

use LiveCMS\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy extends ModelPolicy
{
    public function before(User $user)
    {
        return $user->is_administer;
    }
}
