<?php

namespace App\Mappers;

use App\Entity\User;
use App\Data\Database\ActiveRecords\UserActiveRecord;
use Exception;

class UserToUserActiveRecordMapper
{
    /**
     * @param User $user
     * @return UserActiveRecord
     * @throws Exception
     */
    public function transform(User $user): UserActiveRecord
    {
        return UserActiveRecord::add($user->getName(), $user->getEmail(), $user->getAvatar());
    }
}
