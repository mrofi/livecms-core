<?php

namespace App\Models;

use Carbon\Carbon;
use LiveCMS\Models\PostableModel;
use LiveCMS\Models\Traits\AdminModelTrait;

class Gallery extends PostableModel
{
    use AdminModelTrait;

    protected $excepts = ['author_id', 'published_at'];

    protected $aliases = ['content' => 'Description'];
     
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
     
        $this->prefixSlug = globalParams('slug_gallery', config('livecms.slugs.gallery'));
    }

    public function rules()
    {
        $rules = parent::rules();

        return array_merge($rules, ['content' => '']);
    }
}
