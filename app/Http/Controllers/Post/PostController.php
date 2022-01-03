<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Exports\PostsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\PostUploadRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Imports\PostsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

/**
 * This is Post controller.
 */
class PostController extends Controller
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
     * To show post create view
     * 
     * @return View post create view
     */
    public function showPostCreateView()
    {
        return view('post.create');
    }

    /**
     * To show post create confirm view
     * 
     * @param CreatePostRequest $request
     * @return View post create confirm view
     */
    public function showPostCreateConfirmView(CreatePostRequest $request)
    {        
        $validated = $request->validated();
        return view('post.create_confirm')->with(['post' => $request]);
    }

    /**
     * To back post create view
     * 
     * @return View post create view
     */
    public function backPostCreateView(Request $request) 
    {
        return view('post.create')->with(['post' => $request]);
    }

    /**
     * To create post
     * 
     * @param CreatePostRequest $request
     * @return View post list view 
     */
    public function createPost(Request $request) 
    {
        $post = $this->postServiceInterface->createPost($request);
        return redirect('/post/list');
    }

    /**
     * To show post edit view
     * 
     * @param $postId
     * @return View post edit view
     */
    public function showPostEditView($postId)
    {
        $post = $this->postServiceInterface->getPostById($postId);
        return view('post.edit')->with(['post' => $post]);
    }

    /**
     * To show post edit confirm view
     * 
     * @param UpdatePostRequest $request
     * @param $postId
     * @return View post edit confirm view
     */
    public function showPostEditConfirmView(UpdatePostRequest $request, $postId)
    {
        $validated = $request->validated();
        return view('post.edit_confirm')->with(['post' => $request, 'id' => $postId]);
    }

    /**
     * To update post
     * 
     * @param Request $request
     * @param $postId
     * @return View post list view 
     */
    public function updatePost(Request $request, $postId) 
    {
        $post = $this->postServiceInterface->updatePost($request, $postId);
        return redirect('/post/list');
    }

    /**
     * To delete post
     * 
     * @param $postId
     * @return View post list view with message
     */
    public function deletePost($postId) {
        $message = $this->postServiceInterface->deletePost($postId);
        return redirect('/post/list')->with(['message' => $message]);
    }

    /**
     * To show post list view
     * 
     * @return View post list view
     */
    public function showPostListView()
    {
        $posts = $this->postServiceInterface->getPostList();
        $users = $this->userServiceInterface->getUserList();
        return view('post.list')->with(['posts' => $posts, 'users' => $users]);
    }

    /**
     * To show post upload view
     * 
     * @return View post upload view
     */
    public function showPostUploadView()
    {
        return view('post.upload');
    }

    /**
     * To import posts
     * 
     * @param PostUploadRequest $request
     * @return View post list view
     */
    public function importPosts(PostUploadRequest $request) {
        $validated = $request->validated();
        DB::transaction(function () use ($request) {
            Excel::import(new PostsImport, $request->file('postFile'));
        });
        return redirect('/post/list');
    }

    /**
     * To download post list
     * 
     * @return csv file download
     */
    public function exportPosts() {
        return Excel::download(new PostsExport($this->postServiceInterface), 'posts.xlsx');
    }
}
