<?php

namespace App\Dao\Post;

use App\Models\Post;
use App\Contracts\Dao\Post\PostDaoInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Data accessing object for post
 */
class PostDao implements PostDaoInterface
{
    /**
     * To create post
     * 
     * @param Request $request validated request
     * @return Object $post created post
     */
    public function createPost($request) {
        return DB::transaction(function () use ($request) {
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->created_user_id = Auth::user()->id;
            $post->updated_user_id = Auth::user()->id;
            $post->save();
        });
    }

    /**
     * To get post by id
     * 
     * @param $postId
     * @return Object $post
     */
    public function getPostById($postId) {
        return Post::find($postId);
    }

    /**
     * To update post
     * 
     * @param Request $request validated request
     * @param $postId
     * @return Object $post updated post
     */
    public function updatePost($request, $postId) {
        return DB::transaction(function () use ($request, $postId) {
            $post = Post::find($postId);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->status = $request->status;
            $post->updated_user_id = Auth::user()->id;
            $post->save();
        });
    }

    /**
     * To get post list
     * 
     * @return Object[] $posts
     */
    public function getPostList() {
        if (Auth::check()) {
            if(auth()->user()->type == 0) {
                return Post::orderBy('id', 'asc')->get();
            } else {
                return Post::orderBy('id', 'asc')->where('created_user_id', auth()->user()->id)->get();
            }
        }
        else {
            return Post::orderBy('id', 'asc')->where('status', 1)->get();
        }        
    }

    /**
     * To get post list for export
     * 
     * @return Object[] $posts
     */
    public function getPostListForExport() {
        return DB::table("posts")->select('posts.id', 'posts.title', 'posts.description',
                DB::raw('(CASE WHEN posts.status = 1 THEN "Active" ELSE "Inactive" END) AS status'),
                'posts.created_user_id', 'posts.updated_user_id',
                DB::raw('DATE_FORMAT(posts.created_at, "%Y/%m/%d") as created_at'),
                DB::raw('DATE_FORMAT(posts.updated_at, "%Y/%m/%d") as updated_at'),      
        )->where('posts.deleted_at', null)->get();       
    }

    /**
     * To delete post
     * 
     * @param $postId
     * @return string $message
     */
    public function deletePost($postId) {
        DB::transaction(function () use ($postId) {
            $post = Post::find($postId);
            $post->deleted_user_id = Auth::user()->id;            
            $post->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
            $post->save();
        });
        return "Delete Successful";
    }
}