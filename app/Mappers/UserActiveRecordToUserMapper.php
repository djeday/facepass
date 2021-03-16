<?php

namespace App\Mappers;

use App\Entity\User;
use App\Data\Database\ActiveRecords\UserActiveRecord;
use Illuminate\Database\Eloquent\Collection;

class UserActiveRecordToUserMapper
{
    /**
     * @param UserActiveRecord $userModel
     * @return User
     */
    public function transformOneRecord(UserActiveRecord $userModel): User
    {
        $user = new User();
        $user->setId($userModel->id);
        $user->setName($userModel->name);
        $user->setEmail($userModel->email);
        $userMedia = $userModel->getMedia('avatars');
        $user->setAvatar($userMedia[0]->getUrl());

        return $user;
    }

    /**
     * @param Collection $userModels
     * @return User[]
     */
    public function transformMultipleRecords(Collection $userModels): array
    {
        $users = [];
        foreach ($userModels as $userModel) {
            $users []= $this->transformOneRecord($userModel);
        }
        return $users;
    }
}
