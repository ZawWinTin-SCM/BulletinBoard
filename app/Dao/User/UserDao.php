<?php

namespace App\Dao\User;

use App\Models\User;
use App\Contracts\Dao\User\UserDaoInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * Data accessing object for user
 */
class UserDao implements UserDaoInterface
{
    /**
     * To get user list
     * 
     * @return Object[] $users
     */
    public function getUserList() {
        return User::orderBy('id', 'asc')->get();
    }

    /**
     * To create user
     * 
     * @param Request $request validated request
     * @return Object $user created user
     */
    public function createUser($request) {
        return DB::transaction(function () use ($request) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->profile = $request->profile;
            $user->type = $request->type;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->dob = $request->dob;
            $user->created_user_id = Auth::user()->id ?? count(User::all()) + 1;
            $user->updated_user_id = Auth::user()->id ?? count(User::all()) + 1;
            $user->save();
        });
    }

    /**
     * To get user by id
     * 
     * @param $userId
     * @return Object $user
     */
    public function getUserById($userId) {
        return User::find($userId);
    }

    /**
     * To count total users 
     * 
     * @return string number of posts
     */
    public function countTotalUsers()
    {
        $count = DB::table("users")->count();
        return $count;
    }

    /**
     * To delete user
     * 
     * @param $userId
     * @return string $message
     */
    public function deleteUser($userId) {
        DB::transaction(function () use ($userId) {
            $user = User::find($userId);
            $user->deleted_user_id = Auth::user()->id;
            $user->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();
        });
        return "Delete Successful";
    }

    /**
     * To edit user
     * 
     * @param Request $request validated request
     * @return Object $user updated user
     */
    public function editProfile($request) {
        return DB::transaction(function () use ($request) {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->profile = $request->profile;
            $user->type = $request->type;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->dob = $request->dob;
            $user->updated_user_id = Auth::user()->id;
            $user->save();
        });
    }

    /**
     * To change password
     * 
     * @param PasswordChangeRequest $request
     * @return Object $user
     */
    public function changePassword($request) {
        return DB::transaction(function () use ($request) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->newPwd);
            $user->updated_user_id = Auth::user()->id;
            $user->save();
        });
    }

    /**
     * To reset password
     * 
     * @param Request $request
     * @return Object $user
     */
    public function resetPassword($request) {
        return DB::transaction(function () use ($request) {
            User::where('email', $request->email)->update(['password' => Hash::make($request->newPassword)]);
        });
    }
}