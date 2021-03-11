<?php

namespace App\Domain\Facade;

use App\Domain\Repository\UserRepositoryInterface;

class UserFacade implements UserFacadeInterface
{

    private UserRepositoryInterface $userRepository;

    private UserRepositoryInterface $facebookUserRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserRepositoryInterface $facebookUserRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->facebookUserRepository = $facebookUserRepository;
    }

    public function importUsers(): int
    {
        $users = $this->facebookUserRepository->getAllUsers();
        foreach ($users as $user) {
            $this->userRepository->persist($user);
        }
        return count($users);
    }
}
