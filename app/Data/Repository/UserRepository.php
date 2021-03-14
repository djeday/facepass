<?php

namespace App\Data\Repository;

use App\Data\Database\ActiveRecords\UserActiveRecord;
use App\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

use App\Mappers\UserActiveRecordToUserMapper;
use App\Mappers\UserToUserActiveRecordMapper;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    private const NOT_FOUND_CODE = 404;

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
     */
    public function getAllUsers(): array
    {
        $userModels = UserActiveRecord::all();
        if (is_null($userModels))
            throw new ModelNotFoundException("Users are not found!", self::NOT_FOUND_CODE);

        $mapper = new UserActiveRecordToUserMapper();

        return $mapper->transformMultipleRecords($userModels);
    }

    /**
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function getUserById(int $id): User
    {
        $userModel = UserActiveRecord::all()->find($id);
        $mapper = new UserActiveRecordToUserMapper();
        if (is_null($userModel))
            throw new ModelNotFoundException("User not found!", self::NOT_FOUND_CODE);

        return $mapper->transformOneRecord($userModel);
    }
}
