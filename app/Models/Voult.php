<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voult extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'category',
        'service_url',
        'service_password',
        'user_id',
        'service_username',
        'service_email',
    ];

    //relationship with user hasMany relationship
   public function user()
    {
         return $this->belongsTo(User::class);
    }

    //storing only date in database eg. 2021-03-02
    protected function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = date('Y-m-d', strtotime($value));
    }

    // while selecting date from table it should be in eg. '2 March 2004' format
    // use acessor
    public function getCreatedAtAttribute($value)
    {
        return date('d F Y', strtotime($value));
    }
    // public function getUpdatedAtAttribute($value)
    // {
    //     return date('d F Y', strtotime($value));
    // }

    // while storing service_password it should be hashed
    public function setServicePasswordAttribute($value)
    {
        $this->attributes['service_password'] = encrypt($value);
    }

    //while getting service_password it should be decrypted
    public function getServicePasswordAttribute($value)
    {
        return decrypt($value);
    }

    // while gettting id it should be encrypted
   public function getIdAttribute($value)
    {
        return encrypt($value);
    }

    // while getting userid it should be encrypted
    public function getUserIdAttribute($value)
    {
        return encrypt($value);
    }

    // while storing service_username it should be encrypted and decrypted while getting
    public function setServiceUsernameAttribute($value)
    {
        $this->attributes['service_username'] = encrypt($value);
    }
    public function getServiceUsernameAttribute($value)
    {
        return decrypt($value);
    }

    // while storing service_email it should be encrypted and decrypted while getting
    public function setServiceEmailAttribute($value)
    {
        $this->attributes['service_email'] = encrypt($value);
    }
    public function getServiceEmailAttribute($value)
    {
        return decrypt($value);
    }
    
}

