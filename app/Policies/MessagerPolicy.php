<?php

namespace App\Policies;

use App\Models\Messager;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function recallMessage(User $user, Messager $messager)
    {
        return $user->id === $messager->user_id;
    }
    public function deleteMessage(User $user, Messager $messager)
    {
        return $user->id === $messager->user_id;
    }
}
