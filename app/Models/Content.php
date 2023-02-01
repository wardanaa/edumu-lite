<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $customer_id
 * @property integer $content_category_id
 * @property string $type
 * @property string $name
 * @property string $author
 * @property string $alias
 * @property string $image
 * @property string $file
 * @property string $file_size
 * @property string $url
 * @property string $short_description
 * @property string $description
 * @property boolean $active
 * @property string $created_at
 * @property string $updated_at
 * @property Customer $customer
 * @property ContentComment[] $contentComments
 * @property ContentRate[] $contentRates
 */
class Content extends Model {

    const TYPE_CONTENT = 'content';
    const TYPE_NEWS = 'news';
    const TYPE_PAGE = 'page';
    const TYPE_E_BOOK = 'e-book';


    const FILE_PATH = '/file/content';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content';

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'content_category_id',
        'type',
        'name',
        'author',
        'alias',
        'image',
        'file',
        'file_size',
        'url',
        'short_description',
        'description',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentComments() {
        return $this->hasMany(ContentComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentRates() {
        return $this->hasMany(ContentRate::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contentCategory() {
        return $this->belongsTo(ContentCategory::class);
    }

    public function getImageLocationAttribute(){
        return url('storage/' . $this->image);
    }

    public function getFileLocationAttribute(){
        return url('storage/' . $this->file);
    }

    public function lists(){

    }
}
