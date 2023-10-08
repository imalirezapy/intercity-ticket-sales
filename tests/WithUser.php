<?php
namespace Tests;
use App\Data\Models\User;

trait WithUser
{
    private User $user;

    private function setUser(): void
    {
        $this->user = User::factory()->createOne();
    }
}
