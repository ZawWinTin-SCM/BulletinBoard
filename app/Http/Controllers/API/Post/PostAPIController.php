<?php

namespace App\Http\Controllers\API\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;

/**
 * This is Post API controller.
 */
class PostAPIController extends Controller
{
    /**
     * post service interface
     */
    private $postServiceInterface;

    /**
     * user service interface
     */
    private $userServiceInterface;

    /**
     * Class Constructor
     * 
     * @param PostServiceInterface
     * @param UserServiceInterface
     * @return
     */
    public function __construct(PostServiceInterface $postServiceInterface, UserServiceInterface $userServiceInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
        $this->userServiceInterface = $userServiceInterface;
    }

    /**
     * To show post detail
     * 
     * @param $postId
     * @return Response json with post and user list
     */
    public function showPostDetail($postId) {
        $post = $this->postServiceInterface->getPostById($postId);
        $users = $this->userServiceInterface->getUserList();
        return response()->json([ "post" => $post, "users" => $users]);
    }
}
