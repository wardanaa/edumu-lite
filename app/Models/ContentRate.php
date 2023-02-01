<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $content_id
 * @property integer $customer_id
 * @property integer $rating
 * @property string $created_at
 * @property string $updated_at
 * @property Content $content
 * @property Customer $customer
 */
class ContentRate extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'content_rate';

    /**
     * @var array
     */
    protected $fillable = ['content_id', 'customer_id', 'rating', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
