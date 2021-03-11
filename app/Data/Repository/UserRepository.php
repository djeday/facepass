<?php

namespace App\Data\Repository;

use App\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Exceptions\NotSupportedException;
use App\Mappers\UserToUserActiveRecordMapper;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     * @throws Exception
     */
    public function persist(User $user): void
    {
        $mapper = new UserToUserActiveRecordMapper();
        $userActiveRecord = $mapper->transform($user);
        $userActiveRecord->save();
    }

    /**
     * @return User[]
     * @throws NotSupportedException
     */
    public function getAllUsers(): array
    {
        throw new NotSupportedException("Method not supported");
    }

    /**
     * @param int $id
     * @return User
     * @throws NotSupportedException
     */
    public function getUserById(int $id): User
    {
        throw new NotSupportedException("Method not supported");
    }
}
