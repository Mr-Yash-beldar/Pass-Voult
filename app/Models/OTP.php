<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'code',
        'created_at'
    ];

    //muttor for storing code in db encrypted
    protected function setCodeAttribute($value)
    {
        $this->attributes['code'] = encrypt($value);
    }

    //accessor for getting code from db decrypted
    protected function getCodeAttribute($value)
    {
        return decrypt($value);
    }

    //muttor for storing user_id in db encrypted
    // protected function getUserIdAttribute($value)
    // {
    //     return encrypt($value);
    // }


    

    //relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
