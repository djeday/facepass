<?php

namespace App\Data\Repository;

use App\Data\Database\ActiveRecords\UserActiveRecord;
use App\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

use App\Mappers\UserActiveRecordToUserMapper;
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
     * @throws Exception
     */
    public function getAllUsers(): array
    {
        $userModels = UserActiveRecord::all();
        $mapper = new UserActiveRecordToUserMapper();

        return $mapper->transformMultipleRecords($userModels);
    }

    /**
     * @param int $id
     * @return User
     * @throws Exception
     */
    public function getUserById(int $id): User
    {
        $userModel = UserActiveRecord::all()->find($id);
        $mapper = new UserActiveRecordToUserMapper();

        return $mapper->transformOneRecord($userModel);
    }
}
