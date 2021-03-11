<?php

namespace App\Data\Repository;

use App\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Exceptions\NotSupportedException;
use App\Mappers\GraphNodeToUserMapper;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class FacebookUserRepository implements UserRepositoryInterface
{
    private const APP_ID = 270063341347682;

    private const APP_SECRET = 'd793c2c9a8bbad04185c040abb8c86c7';

    private const ACCESS_TOKEN = 'EAAD1nwWHI2IBALhwHWflRHfUsJExWZAWQKZBE5E7g42KiF8apoehi4KrGkIu6bDHEoKnO2QnEh5Kd9bPZBshAy6YUo9rNI5P0tNMoGMeTkZBW6HZB3Kguyf5USkAC3aBiKQUenKhQa5iEVXx1zzlpY5IlupvfGZClVCpLmRGBwViyDtYuijJir';

    private array $accessPermissions = ['name', 'picture', 'email'];

    /**
     * @param User $user
     * @throws NotSupportedException
     */
    public function persist(User $user): void
    {
        throw new NotSupportedException("Method not supported");
    }

    /**
     * @return User[]
     * @throws FacebookSDKException
     */
    public function getAllUsers(): array
    {
        $users = [];
        $facebook = new Facebook(
            [
                'app_id' => self::APP_ID,
                'app_secret' => self::APP_SECRET,
                'default_graph_version' => 'v10.0'
            ]);
        $userResponse = $facebook->get('/me', self::ACCESS_TOKEN);
        $currentUser = $userResponse->getGraphUser();
        $friendsResponse = $facebook->get(
            '/' . $currentUser->getId() . '/friends/?fields='
            . implode(',', $this->accessPermissions),
            self::ACCESS_TOKEN
        );

        $friends = $friendsResponse->getGraphEdge();
        foreach ($friends as $friend) {
            $users [] = (new GraphNodeToUserMapper())->transform($friend);
        }

        return $users;
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
