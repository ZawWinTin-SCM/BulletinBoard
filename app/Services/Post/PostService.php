<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;

/**
 * Service class for post.
 */
class PostService implements PostServiceInterface
{
    /**
     * post dao interface
     */
    private $postDaoInterface;
    
    /**
     * Class Constructor
     * 
     * @param PostDaoInterface
     * @return
     */
    public function __construct(PostDaoInterface $postDaoInterface)
    {
        $this->postDaoInterface = $postDaoInterface;
    }
    
    /**
     * To save post
     * 
     * @param Request $request validated request
     * @return Object $post saved post
     */
    public function createPost($request) {
        return $this->postDaoInterface->createPost($request);
    }

    /**
     * To get post by id
     * 
     * @param $postId
     * @return Object $post
     */
    public function getPostById($postId) {
        return $this->postDaoInterface->getPostById($postId);
    }

    /**
     * To update post
     * 
     * @param Request $request validated request
     * @param $postId
     * @return Object $post updated post
     */
    public function updatePost($request, $postId) {
        return $this->postDaoInterface->updatePost($request, $postId);
    }

    /**
     * To get post list
     * 
     * @return Object[] $posts
     */
    public function getPostList() {
        return $this->postDaoInterface->getPostList();
    }
    
    /**
     * To get post list for export
     * 
     * @return Object[] $posts
     */
    public function getPostListForExport() {
        return $this->postDaoInterface->getPostListForExport();
    }

    /**
     * To delete post
     * 
     * @param $postId
     * @return string $message
     */
    public function deletePost($postId) {
        return $this->postDaoInterface->deletePost($postId);
    }
}