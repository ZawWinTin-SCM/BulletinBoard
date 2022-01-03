<?php

namespace App\Contracts\Dao\Post;

/**
 * Interface for Data Accessing Object of post
 */
interface PostDaoInterface
{
    /**
     * To save post
     * 
     * @param Request $request validated request
     * @return Object $post saved post
     */
    public function createPost($request);

    /**
     * To get post by id
     * 
     * @param $postId
     * @return Object $post
     */
    public function getPostById($postId);

    /**
     * To update post
     * 
     * @param Request $request validated request
     * @param $postId
     * @return Object $post updated post
     */
    public function updatePost($request, $postId);

    /**
     * To get post list
     * 
     * @return Object[] $posts
     */
    public function getPostList();

    /**
     * To get post list for export
     * 
     * @return Object[] $posts
     */
    public function getPostListForExport();
    
    /**
     * To delete post
     * 
     * @param $postId
     * @return string $message
     */
    public function deletePost($postId);
}