<?php

namespace App\Dao\PasswordReset;

use App\Models\PasswordReset;
use App\Contracts\Dao\PasswordReset\PasswordResetDaoInterface;
use Illuminate\Support\Facades\DB;

/**
 * Data accessing object for password reset
 */
class PasswordResetDao implements PasswordResetDaoInterface
{
    /**
     * To add password reset token with email
     * 
     * @param Request $request validated request
     * @param $token
     * @return Object $added password_reset object
     */
    public function addPasswordResetToken($request, $token) {
        return DB::transaction(function () use ($request, $token) {
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
            ]);
        });
    }

    /**
     * To get email by token
     * 
     * @param $token
     * @return string $email
     */
    public function getEmailByToken($token) {
        return PasswordReset::where('token', $token)->value('email');
    }

    /**
     * To get password reset token with email
     * 
     * @param Request $request validated request
     * @return Object $added password_reset object
     */
    public function getPasswordResetObject($request) {
        return DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
    }

    /**
     * To remove token of email
     * 
     * @param Request $request validated request
     * @return 
     */
    public function removeTokenByEmail($request) {
        DB::transaction(function () use ($request) {
            DB::table('password_resets')->where(['email'=> $request->email])->delete();
        });
    }
}
