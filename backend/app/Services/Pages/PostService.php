<?php
namespace App\Services\Pages;

use App\Interfaces\Pages\PostInterface;

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
}
