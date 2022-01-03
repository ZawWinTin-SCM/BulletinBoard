<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

/**
 * Service class for User.
 */
class UserService implements UserServiceInterface
{
    /**
     * user dao interface
     */
    private $userDaoInterface;

    /**
     * Class Constructor
     * 
     * @param UserDaoInterface
     * @return
     */
    public function __construct(UserDaoInterface $userDaoInterface)
    {
        $this->userDaoInterface = $userDaoInterface;
    }

    /**
     * To get user list
     * 
     * @return Object[] $users
     */
    public function getUserList()
    {
        return $this->userDaoInterface->getUserList();
    }

    /**
     * To store user temporary profile
     * 
     * @return string temporary file name
     */
    public function storeTempProfile($request)
    {
        $newUserId = $this->userDaoInterface->countTotalUsers() + 1;
        $uploadFile = $request->file('profile');
        $extension = $uploadFile->getClientOriginalExtension();
        $destinationPath = public_path() . '/images/temp/';
        $tempName = "profile_" . $newUserId . "." . $extension;
        $uploadFile->move($destinationPath, $tempName);
        return $tempName;
    }

    /**
     * To create user
     * 
     * @param Request $request validated request
     * @return Object $user created user
     */
    public function createUser($request)
    {
        $newUserId = $this->userDaoInterface->countTotalUsers() + 1;
        $tempPath = public_path() . '/images/temp/';
        $profilePath = public_path() . '/images/profile/';
        $profileName = "profile_" . $newUserId;
        $extension = "";
        $files = File::allFiles($tempPath);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_FILENAME) == $profileName) {
                $extension = pathinfo($file, PATHINFO_EXTENSION);
            }
        }
        $profileNameWithExtension = $profileName . "." . $extension;
        File::move($tempPath . $profileNameWithExtension, $profilePath . $profileNameWithExtension);
        File::delete($files);
        $request->profile = $profileNameWithExtension;
        return $this->userDaoInterface->createUser($request);
    }

    /**
     * To get user by id
     * 
     * @param $userId
     * @return Object $user
     */
    public function getUserById($userId)
    {
        return $this->userDaoInterface->getUserById($userId);
    }

    /**
     * To delete user
     * 
     * @param $userId
     * @return string $message
     */
    public function deleteUser($userId)
    {
        $profileName = "profile_" . $userId;
        $destinationPath = public_path() . '/images/profile/';
        $files = File::allFiles($destinationPath);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_FILENAME) == $profileName) {
                File::delete($file);
            }
        }
        return $this->userDaoInterface->deleteUser($userId);
    }

    /**
     * To edit user
     * 
     * @param Request $request validated request
     * @return Object $user updated user
     */
    public function editProfile($request)
    {
        $userId = Auth::user()->id;
        if ($request->hasFile("profile")) {
            $uploadFile = $request->file('profile');
            $extension = $uploadFile->getClientOriginalExtension();
            $profileName = "profile_" . $userId;
            $destinationPath = public_path() . '/images/profile/';
            $files = File::allFiles($destinationPath);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_FILENAME) == $profileName) {
                    File::delete($file);
                }
            }
            $profileNameWithExtension = $profileName . "." . $extension;
            $uploadFile->move($destinationPath, $profileNameWithExtension);
            $request->profile = $profileNameWithExtension;
        } else {
            $request->profile = User::find($userId)->profile;
        }
        return $this->userDaoInterface->editProfile($request);
    }

    /**
     * To change password
     * 
     * @param PasswordChangeRequest $request
     * @return Object $user
     */
    public function changePassword($request)
    {
        return $this->userDaoInterface->changePassword($request);
    }

    /**
     * To reset password
     * 
     * @param Request $request
     * @return Object $user
     */
    public function resetPassword($request) 
    {
        return $this->userDaoInterface->resetPassword($request);
    }
}
