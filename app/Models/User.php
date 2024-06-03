<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Voult;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    //  * The attributes that should be hidden for serialization. while selecting data from table password shoul not

    protected $hidden = [
        'password',
    ];
  


    //  * Get the attributes that should be cast. password should be hashed before saving to database use casted property

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // save the timestamp only 
    protected function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = date('Y-m-d', strtotime($value));
    }

    // protected $casts = [
    //     'created_at' => 'datetime:Y-m-d',
    //     'updated_at' => 'datetime:Y-m-d',
    // ];

    // while selecting date from table it should be in eg. '2 March 2004' format
    // use acessor
    public function getCreatedAtAttribute($value)
    {
        return date('d F Y', strtotime($value));
    }

    //upadated day should be as eg. 2 months ago, 2 days ago, 2 march 2008
    public function getUpdatedAtAttribute($value)
    {
        return date('d F Y', strtotime($value));
    }



  

    public function voults()
    {
        return $this->hasMany(Voult::class);
    }

    //  * Get the verification code associated with the user.
    // In User.php
    public function OTP()
    {
        return $this->hasOne(OTP::class); // Assuming OTP is your model for the verification code
    }


}
