<?php
namespace App\Interfaces\Pages;

interface PostInterface {

    /**
     * @param bool $isMyPost
     * @param string $title
     * @param string $content
     * @param string $tag
     * @param null $otherQuery
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function getPostList($isMyPost = false, $title = null, $content = null, $tag = null, $otherQuery = null);

    /**
     * @param $userId
     * @param $title
     * @param $content
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function storePostToUser($userId, $title, $content);

    /**
     * @param $userId
     * @param $postId
     * @return mixed
     */
    public function deletePost($userId, $postId);

    /**
     * @param $userId
     * @param $postId
     * @param $title
     * @param $content
     * @return int
     */
    public function updatePost($userId, $postId, $title, $content);

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     */
    public function firstWithId($id);

    /**
     * @param $postId
     * @param $tagId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreateForPostTag($postId, $tagId);
}
