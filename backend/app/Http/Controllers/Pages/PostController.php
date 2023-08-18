<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\Posts\GetPostListRequest;
use App\Http\Requests\Pages\Posts\StorePostRequest;
use App\Services\Pages\PostService;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @var PostService
     */
    private $postService;

    /**
     * PostController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param GetPostListRequest $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getPostList(GetPostListRequest $request)
    {
        return $this->postService->getPostList(boolval($request->is_my_post === "true"), $request->title, $request->get('content'));
    }

    /**
     * @param StorePostRequest $request
     * @return mixed
     */
    public function storePost(StorePostRequest $request)
    {
        return $this->postService->storePost($request->title, $request->get('content'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id)
    {
        return $this->postService->deletePost(Auth::id(), $id);
    }
}
