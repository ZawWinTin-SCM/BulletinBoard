<?php

namespace App\Services\PasswordReset;

use App\Contracts\Dao\PasswordReset\PasswordResetDaoInterface;
use App\Contracts\Services\PasswordReset\PasswordResetServiceInterface;

/**
 * Service class for PasswordReset.
 */
class PasswordResetService implements PasswordResetServiceInterface
{
    /**
     * passwordReset dao
     */
    private $passwordResetDaoInterface;
    
    /**
     * Class Constructor
     * @param PasswordResetDaoInterface
     * @return
     */
    public function __construct(PasswordResetDaoInterface $passwordResetDaoInterface)
    {
        $this->passwordResetDaoInterface = $passwordResetDaoInterface;
    }

    /**
     * To add password reset token with email
     * 
     * @param Request $request validated request
     * @param $token
     * @return Object $added password_reset object
     */
    public function addPasswordResetToken($request, $token) {
        return $this->passwordResetDaoInterface->addPasswordResetToken($request, $token);
    }

    /**
     * To get email by token
     * 
     * @param $token
     * @return string $email
     */
    public function getEmailByToken($token) {
        return $this->passwordResetDaoInterface->getEmailByToken($token);
    }

    /**
     * To get password reset token with email
     * 
     * @param Request $request validated request
     * @return Object $added password_reset object
     */
    public function getPasswordResetObject($request) {
        return $this->passwordResetDaoInterface->getPasswordResetObject($request);
    }

    /**
     * To remove token of email
     * 
     * @param Request $request validated request
     * @return 
     */
    public function removeTokenByEmail($request) {
        $this->passwordResetDaoInterface->removeTokenByEmail($request);
    }
}