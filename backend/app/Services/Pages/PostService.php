<?php
namespace App\Services\Pages;

use App\Interfaces\Pages\PostInterface;
use Illuminate\Support\Facades\Auth;

class PostService {
    /**
     * @var PostInterface
     */
    private $postRepository;

    /**
     * PostService constructor.
     * @param PostInterface $postRepository
     */
    public function __construct(PostInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param bool $isMyPost
     * @param null $title
     * @param null $content
     * @param null $tag
     * @param null $otherQuery
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getPostList($isMyPost = false, $title = null, $content = null, $tag = null, $otherQuery = null)
    {
        return $this->postRepository->getPostList($isMyPost, $title, $content, $tag, $otherQuery);
    }

    /**
     * @param $title
     * @param $content
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function storePost($title, $content)
    {
        $post = $this->postRepository->storePostToUser(Auth::id(), $title, $content);
        $this->bindTagToPost($post->id, $content);

        return $post;
    }

    /**
     * @param $userId
     * @param $postId
     * @return mixed
     */
    public function deletePost($userId, $postId)
    {
        return $this->postRepository->deletePost($userId, $postId);
    }

    /**
     * @param $postId
     * @param $title
     * @param $content
     * @return mixed
     */
    public function updatePost($postId, $title, $content)
    {
        return $this->postRepository->updatePost(Auth::id(), $postId, $title, $content);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     */
    public function firstWithId($id)
    {
        return $this->postRepository->firstWithId($id);
    }

    /**
     * @param $postId
     * @param $content
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function bindTagToPost($postId, $content)
    {
        preg_match_all('/#(\w+)/', $content, $findTags);

        foreach ($findTags[1] as $findTag){
            $tag = app()->make(TagService::class)->firstOrCreate($findTag);
            $this->postRepository->firstOrCreateForPostTag($postId, $tag->id);
        }
    }
}
