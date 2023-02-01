<?php


namespace App\Models\Traits\Attribute;


use Illuminate\Support\Facades\Hash;

trait CustomerAttribute {

    /**
     * @param $password
     */
    public function setPasswordAttribute($password): void {
        // If password was accidentally passed in already hashed, try not to double hash it
        if (
            (\strlen($password) === 60 && preg_match('/^\$2y\$/', $password)) ||
            (\strlen($password) === 95 && preg_match('/^\$argon2i\$/', $password))
        ) {
            $hash = $password;
        } else {
            $hash = Hash::make($password);
        }

        $this->attributes['password'] = $hash;
    }

    /**
     * @return mixed
     */
    public function getPictureAttribute() {
        if (empty($this->image)) {
            return null;
        } else {
            return url('storage/' . $this->image);
        }
    }

}