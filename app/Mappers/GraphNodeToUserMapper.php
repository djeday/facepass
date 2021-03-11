<?php

namespace App\Mappers;

use App\Entity\User;
use Facebook\GraphNodes\GraphNode;

class GraphNodeToUserMapper
{
    public function transform(GraphNode $friend): User
    {
        $user = new User();
        $user->setName($friend->getField('name'));
        $user->setEmail($friend->getField('email'));
        $user->setAvatar($friend['picture']['url']);

        return $user;
    }
}
