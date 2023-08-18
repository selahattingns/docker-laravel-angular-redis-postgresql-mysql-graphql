<?php
namespace App\Repositories\Pages;

use App\Models\Post;
use App\Interfaces\Pages\PostInterface;
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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getPostList($isMyPost = false, $title = null, $content = null)
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
            ->get()->map(function ($row) {
                $row->is_my_post = $row->user_id === Auth::id();
                return $row;
            });
    }
}
