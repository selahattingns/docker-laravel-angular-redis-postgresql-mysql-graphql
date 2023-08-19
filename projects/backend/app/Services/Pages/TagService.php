<?php
namespace App\Services\Pages;

use App\Interfaces\Pages\TagInterface;

class TagService
{
    /**
     * @var TagInterface
     */
    private $tagRepository;

    /**
     * TagService constructor.
     * @param TagInterface $tagRepository
     */
    public function __construct(TagInterface $tagRepository)
    {
        $this->tagRepository= $tagRepository;
    }

    /**
     * @param $tag
     * @return mixed
     */
    public function firstOrCreate($tag)
    {
        return $this->tagRepository->firstOrCreate($tag);
    }
}
