<?php
namespace App\Interfaces\Pages;

interface TagInterface
{

    /**
     * @param $tag
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function firstOrCreate($tag);
}
