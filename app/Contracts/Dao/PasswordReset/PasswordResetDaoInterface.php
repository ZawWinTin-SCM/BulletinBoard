<?php

namespace App\Contracts\Dao\PasswordReset;

/**
 * Interface for Data Accessing Object of password reset
 */
interface PasswordResetDaoInterface
{
    /**
     * To add password reset token with email
     * 
     * @param Request $request validated request
     * @param $token
     * @return Object $added password_reset object
     */
    public function addPasswordResetToken($request, $token);

    /**
     * To get email by token
     * 
     * @param $token
     * @return string $email
     */
    public function getEmailByToken($token);

    /**
     * To get password reset token with email
     * 
     * @param Request $request validated request
     * @return Object $added password_reset object
     */
    public function getPasswordResetObject($request);

    /**
     * To remove token of email
     * 
     * @param Request $request validated request
     * @return 
     */
    public function removeTokenByEmail($request);
}