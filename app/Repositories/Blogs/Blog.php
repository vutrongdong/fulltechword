<?php

namespace App\Repositories\Blogs;

use App\Repositories\Entity;

class Blog extends Entity
{
    /**
     * Full path of images.
     */
    public $imgPath = 'storage/images/blogs';

    /**
     * Physical path of upload folder.
     */
    public $uploadPath = 'app/public/images/blogs';

    /**
     * Image width.
     */
    public $imgWidth = 1024;

    /**
     * Image height.
     */
    public $imgHeight = 500;

    const ENABLE = 1;
    const DISABLE = 0;
    /**
     * Fillable definition
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'teaser',
        'content',
        'active',
        'hot',
        'category_id',
        'author_id',
    ];

    public function scopeQ($query, $value = null)
    {
        if ($value) {
            return $query->where('title', 'like', "%{$value}%")
                        ->orWhere('teaser', 'like', "%{$value}%")
                        ->orWhere('content', 'like', "%{$value}%");
        }
        return $query;
    }
}
