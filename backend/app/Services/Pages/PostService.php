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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getPostList($isMyPost = false, $title = null, $content = null)
    {
        return $this->postRepository->getPostList($isMyPost, $title, $content);
    }

    /**
     * @param $title
     * @param $content
     * @return mixed
     */
    public function storePost($title, $content)
    {
        return $this->postRepository->storePostToUser(Auth::id(), $title, $content);
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
}
