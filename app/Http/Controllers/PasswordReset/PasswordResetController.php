<?php

namespace App\Http\Controllers\PasswordReset;

use App\Contracts\Services\PasswordReset\PasswordResetServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordSubmitRequest;
use App\Http\Requests\ResetPasswordSubmitRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

/**
 * This is PasswordReset controller.
 */
class PasswordResetController extends Controller
{
    /**
     * password reset service interface
     */
    private $passwordResetServiceInterface;

    /**
     * password reset service interface
     */
    private $userServiceInterface;

    /**
     * Class Constructor
     * 
     * @param PasswordResetServiceInterface
     * @param UserServiceInterface
     * @return
     */
    public function __construct(PasswordResetServiceInterface $passwordResetServiceInterface, UserServiceInterface $userServiceInterface)
    {
        $this->passwordResetServiceInterface = $passwordResetServiceInterface;
        $this->userServiceInterface = $userServiceInterface;
    }

    /**
     * To show forget password view
     * 
     * @return View forget password view
     */
    public function showForgetPasswordForm()
    {
        return view('auth.forget_password');
    }

    /**
     * To submit forget password form
     * 
     * @param ForgetPasswordSubmitRequest $request
     * @return View forget password view with message
     */
    public function submitForgetPasswordForm(ForgetPasswordSubmitRequest $request)
    {
        $validated = $request->validated();
        $token = Str::random(64);        
        $password_reset = $this->passwordResetServiceInterface->addPasswordResetToken($request, $token);
        Mail::send('email.forget_password', ['token' => $token], function($message) use($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    /**
     * To show reset password view
     * 
     * @param $token
     * @return View reset password view
     */
    public function showResetPasswordForm($token) { 
        $email = $this->passwordResetServiceInterface->getEmailByToken($token);
        return view('auth.reset_password', ['token' => $token, 'email' => $email]);
    }

    /**
     * To submit reset password form
     * 
     * @param ResetPasswordSubmitRequest $request
     * @return View login view
     */
    public function submitResetPasswordForm(ResetPasswordSubmitRequest $request)
    {
        $validated = $request->validated();
        $updatePassword = $this->passwordResetServiceInterface->getPasswordResetObject($request);  
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }  
        $user = $this->userServiceInterface->resetPassword($request);
        $this->passwordResetServiceInterface->removeTokenByEmail($request);
        return redirect('/auth/login');
    }
}
