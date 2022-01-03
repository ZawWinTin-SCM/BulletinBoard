<?php

namespace App\Http\Controllers\API\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;

/**
 * This is User API controller.
 */
class UserAPIController extends Controller
{
    /**
     * user service interface
     */
    private $userServiceInterface;

    /**
     * Class Constructor
     * 
     * @param UserServiceInterface
     * @return
     */
    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userServiceInterface = $userServiceInterface;
    }

    /**
     * To show user detail
     * 
     * @param $userId
     * @return Response json with user
     */
    public function showUserDetail($userId) {
        $user = $this->userServiceInterface->getUserById($userId);
        $users = $this->userServiceInterface->getUserList();
        return response()->json([ "user" => $user, "users" => $users]);
    }
}