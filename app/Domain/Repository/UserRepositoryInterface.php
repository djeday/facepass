<?php

namespace App\Domain\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function persist(User $user): void;

    public function getAllUsers() : array;

    public function getUserById(int $id) : User;

}
