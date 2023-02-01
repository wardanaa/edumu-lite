<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property string $type
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property Content[] $contents
 */
class ContentCategory extends Model {

    const TYPE_CONTENT = 'content';
    const TYPE_NEWS = 'news';
    const TYPE_PAGE = 'page';
    const TYPE_E_BOOK = 'e-book';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_category';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'description',
        'type',
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents() {
        return $this->hasMany(Content::class);
    }
}
