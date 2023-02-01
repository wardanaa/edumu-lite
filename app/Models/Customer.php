<?php

namespace App\Models;

use App\Models\Traits\Attribute\CustomerAttribute;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $id
 * @property string $uuid
 * @property string $email
 * @property string $reg_id
 * @property string $api_token
 * @property string $device_name
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $no_reg
 * @property string $position
 * @property string $company
 * @property string $image
 * @property string $last_login_at
 * @property string $last_login_ip
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $active
 * @property Content[] $contents
 * @property ContentComment[] $contentComments
 * @property ContentRate[] $contentRates
 */
class Customer extends Authenticatable {

    use CustomerAttribute,
        Uuid;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';

    /**
     * @var array
     */
    protected $fillable = [
        'uuid',
        'email',
        'reg_id',
        'api_token',
        'device_name',
        'username',
        'password',
        'name',
        'no_reg',
        'position',
        'company',
        'image',
        'last_login_at',
        'last_login_ip',
        'created_at',
        'updated_at',
        'active'
    ];

    protected $hidden = ['password'];

    protected $dates = ['last_login_at'];

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
     * @return string
     */
    public function getUsername(): string {
        return 'username';
    }
}
