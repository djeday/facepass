<?php

namespace App\Http\Controllers;

use App\Domain\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private const INTERNAL_ERROR = 500;

    private int $statusCode = 200;

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondWithArray(array $array, array $headers = []): JsonResponse
    {
        return response()->json($array, $this->statusCode, $headers, JSON_PRETTY_PRINT);
    }

    public function respondWithMessage($message): JsonResponse
    {
        return $this->respondWithArray([
            'message' => $message,
        ]);
    }

    public function getAll(): JsonResponse
    {
        try {
            $users = $this->userRepository->getAllUsers();
        } catch (Exception $ex) {
            return $this->setStatusCode($ex->getCode() ?? self::INTERNAL_ERROR)
                        ->respondWithMessage($ex->getMessage());
        }
        return $this->respondWithArray(["users" => $users]);
    }

    public function get(int $userId): JsonResponse
    {
        try {
            $userInfo = $this->userRepository->getUserById($userId);
        } catch (Exception $ex) {
            return $this->setStatusCode($ex->getCode() ?? self::INTERNAL_ERROR)
                ->respondWithMessage($ex->getMessage());
        }
        return $this->respondWithArray(["userInfo" => $userInfo]);
    }
}
