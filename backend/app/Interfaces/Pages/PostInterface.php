<?php
namespace App\Interfaces\Pages;

interface PostInterface {

    /**
     * @param bool $isMyPost
     * @param string $title
     * @param string $content
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getPostList($isMyPost = false, $title = null, $content = null);
}
