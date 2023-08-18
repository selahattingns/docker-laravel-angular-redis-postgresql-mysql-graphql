<?php
namespace App\Repositories\Pages;

use App\Models\Post;
use App\Models\PostTag;
use App\Interfaces\Pages\PostInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostInterface {

    /**
     * @var Post
     */
    private $model;

    /**
     * PostRepository constructor.
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @param bool $isMyPost
     * @param string $title
     * @param string $content
     * @param string $tag
     * @param null $otherQuery
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getPostList($isMyPost = false, $title = null, $content = null, $tag = null, $otherQuery = null)
    {
        return $this->model->query()
                ->when($isMyPost, function ($query){
                    $query->where('user_id', Auth::id());
                })
                ->when($title, function ($query) use ($title){
                    $query->where('title', 'like', '%' . $title . '%');
                })
                ->when($content, function ($query) use ($content){
                    $query->where('content', 'like', '%' . $content . '%');
                })
                ->when($tag, function ($query) use ($tag){
                    $query->whereHas('tags', function ($query) use ($tag){
                        $query->where('name', 'like', '%' . $tag . '%');
                    });
                })
                ->when($otherQuery, $otherQuery)
                ->with('user')
                ->with('tags')
                ->withCount('comments')
                ->orderBy('published_at', 'desc')->get()->map(function ($row) {
                    $row->is_my_post = $row->user_id === Auth::id();
                    return $row;
                });
    }

    /**
     * @param $userId
     * @param $title
     * @param $content
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storePostToUser($userId, $title, $content)
    {
        return $this->model->query()->create([
            "user_id" => $userId,
            "title" => $title,
            "content" => $content,
            "published_at" => Carbon::now(),
        ]);
    }

    /**
     * @param $userId
     * @param $postId
     * @return mixed
     */
    public function deletePost($userId, $postId)
    {
        return $this->model->query()->where('user_id', $userId)->where('id', $postId)->delete();
    }

    /**
     * @param $userId
     * @param $postId
     * @param $title
     * @param $content
     * @return int
     */
    public function updatePost($userId, $postId, $title, $content)
    {
        return $this->model->query()->where('user_id', $userId)->where('id', $postId)->update([
            "title" => $title,
            "content" => $content,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     */
    public function firstWithId($id){
        return $this->model->query()->where('id', $id)->with('user')->first();
    }

    /**
     * @param $postId
     * @param $tagId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreateForPostTag($postId, $tagId)
    {
        return PostTag::query()->firstOrCreate([
            "post_id" => $postId,
            "tag_id" => $tagId,
        ]);
    }
}
