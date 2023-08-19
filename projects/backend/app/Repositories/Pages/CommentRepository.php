<?php
namespace App\Repositories\Pages;

use App\Models\Comment;
use App\Interfaces\Pages\CommentInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentInterface {

    /**
     * @var Comment
     */
    private $model;

    /**
     * CommentRepository constructor.
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $postId
     * @param string $content
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getCommentList($postId, $content = null)
    {
        return $this->model->query()
            ->when($content, function ($query) use ($content){
                $query->where('content', 'like', '%' . $content . '%');
            })
            ->with('user')
            ->where('post_id', $postId)
            ->orderBy('created_at', 'asc')->get()->map(function ($row) {
                $row->is_my_comment = $row->user_id === Auth::id();
                $row->formatted_created_at = Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                return $row;
            });
    }

    /**
     * @param $userId
     * @param $postId
     * @param $content
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storeCommentToPost($userId, $postId, $content)
    {
        return $this->model->query()->create([
            "user_id" => $userId,
            "post_id" => $postId,
            "content" => $content
        ]);
    }

    /**
     * @param $userId
     * @param $commentId
     * @return mixed
     */
    public function deleteComment($userId, $commentId)
    {
        return $this->model->query()->where('user_id', $userId)->where('id', $commentId)->delete();
    }

    /**
     * @param $userId
     * @param $commentId
     * @param $content
     * @return int
     */
    public function updateComment($userId, $commentId, $content)
    {
        return $this->model->query()->where('user_id', $userId)->where('id', $commentId)->update([
            "content" => $content,
        ]);
    }
}
