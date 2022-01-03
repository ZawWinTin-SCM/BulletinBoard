<?php

namespace App\Contracts\Dao\User;

/**
 * Interface for Data Accessing Object of user
 */
interface UserDaoInterface
{
    /**
     * To get user list
     * 
     * @return Object[] $users
     */
    public function getUserList();

    /**
     * To create user
     * 
     * @param Request $request validated request
     * @return Object $user created user
     */
    public function createUser($request);

    /**
     * To get user by id
     * 
     * @param $userId
     * @return Object $user
     */
    public function getUserById($userId);

    /**
     * To count total users 
     * 
     * @return string number of posts
     */
    public function countTotalUsers();

    /**
     * To delete user
     * 
     * @param $userId
     * @return string $message
     */
    public function deleteUser($userId);

    /**
     * To edit user
     * 
     * @param Request $request validated request
     * @return Object $user updated user
     */
    public function editProfile($request);

    /**
     * To change password
     * 
     * @param PasswordChangeRequest $request
     * @return Object $user
     */
    public function changePassword($request);

    /**
     * To reset password
     * 
     * @param Request $request
     * @return Object $user
     */
    public function resetPassword($request);
}