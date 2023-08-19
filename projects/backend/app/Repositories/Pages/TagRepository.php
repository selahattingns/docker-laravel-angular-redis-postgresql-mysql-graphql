<?php
namespace App\Repositories\Pages;

use App\Models\Tag;
use App\Interfaces\Pages\TagInterface;

class TagRepository implements TagInterface
{

    /**
     * @var Tag
     */
    private $model;

    /**
     * TagRepository constructor.
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    /**
     * @param $tag
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function firstOrCreate($tag)
    {
        return $this->model->query()->firstOrCreate([
            "name" => $tag
        ]);
    }
}
