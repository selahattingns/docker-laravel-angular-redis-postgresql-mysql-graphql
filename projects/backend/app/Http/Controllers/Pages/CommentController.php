<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\Comments\GetCommentListRequest;
use App\Http\Requests\Pages\Comments\StoreCommentRequest;
use App\Http\Requests\Pages\Comments\UpdateCommentRequest;
use App\Services\Pages\CommentService;
use App\Services\Pages\PostService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * CommentController constructor.
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @param GetCommentListRequest $request
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCommentList(GetCommentListRequest $request)
    {
        return [
            "post" => app()->make(PostService::class)->firstWithId($request->post_id),
            "comments" => $this->commentService->getCommentList($request->post_id, $request->get('content'))
        ];
    }

    /**
     * @param StoreCommentRequest $request
     * @return mixed
     */
    public function storeComment(StoreCommentRequest $request)
    {
        return $this->commentService->storeComment($request->post_id, $request->get('content'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteComment($id)
    {
        return $this->commentService->deleteComment(Auth::id(), $id);
    }

    /**
     * @param UpdateCommentRequest $request
     * @return mixed
     */
    public function updateComment(UpdateCommentRequest $request)
    {
        return $this->commentService->updateComment($request->comment_id, $request->get('content'));
    }
}
