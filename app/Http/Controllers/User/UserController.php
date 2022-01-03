<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\ProfileEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * This is User controller.
 */
class UserController extends Controller
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
     * To show user create view
     * 
     * @return View user register view
     */
    public function showUserCreateView()
    {
        return view('user.register');
    }

    /**
     * To show user create confirm view
     * 
     * @param CreateUserRequest $request
     * @return View user register confirm view
     */
    public function showUserCreateConfirmView(CreateUserRequest $request)
    {
        $validated = $request->validated();
        $tempName = $this->userServiceInterface->storeTempProfile($request);
        return view('user.register_confirm')->with(['user' => $request, "profileName" => $tempName]);
    }

    /**
     * To back user create view
     * 
     * @return View user create view
     */
    public function backUserCreateView(Request $request) 
    {
        return view('user.register')->with(['user' => $request]);
    }

    /**
     * To create user
     * 
     * @param Request $request
     * @return View user list view
     */
    public function createUser(Request $request) 
    {
        $user = $this->userServiceInterface->createUser($request);
        return redirect('/user/list');
    }

    /**
     * To show user list view
     * 
     * @return View user list view
     */
    public function showUserListView()
    {
        $users = $this->userServiceInterface->getUserList();
        return view('user.list')->with(['users' => $users]);
    }

    /**
     * To delete user
     * 
     * @param $postId
     * @return Response json with message
     */
    public function deleteUser($usertId)
    {
        $message = $this->userServiceInterface->deleteUser($usertId);
        return redirect('/user/list')->with(['message' => $message]);
    }

    /**
     * To show user profile view
     * 
     * @return View user profile view
     */
    public function showUserProfileView()
    {
        $user = $this->userServiceInterface->getUserById(Auth::user()->id);
        return view('user.profile')->with(['user' => $user]);
    }

    /**
     * To show user profile edit view
     * 
     * @return View user profile edit view
     */
    public function showUserProfileEditView()
    {
        $user = $this->userServiceInterface->getUserById(Auth::user()->id);
        return view('user.profile_edit')->with(['user' => $user]);
    }

    /**
     * To edit profile
     * 
     * @param ProfileEditRequest $request
     * @return View user profile edit view
     */
    public function editProfile(ProfileEditRequest $request)
    {
        $validated = $request->validated();
        $user = $this->userServiceInterface->editProfile($request);
        return redirect('user/profile');
    }

    /**
     * To show change password view
     * 
     * @return View change password view
     */
    public function showChangePasswordView()
    {
        return view('user.password_change');
    }

    /**
     * To change password
     * 
     * @param PasswordChangeRequest $request
     * @return View change password view
     */
    public function changePassword(PasswordChangeRequest $request)
    {
        $validated = $request->validated();
        if (Hash::check($request->currentPwd, Auth::user()->password)) {            
            $user = $this->userServiceInterface->changePassword($request);
            return redirect('user/profile');
        }
        return back()->withErrors(["currentPwd" => "Current Password is incorrect."]);
    }
}
