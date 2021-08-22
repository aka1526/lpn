<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Members extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'firs_tname',
        'last_name',
        'full_name',
        'gender',
        'dateofbirth',
        'user_tel',
        'khan_uid',
        'khan_no',
        'khan_name',
        'certificate_no',
        'kru_uid',
        'under_kru',
        'club_name',
        'user_address',
        'country_code',
        'country_name',
        'user_facebook',
        'user_ig',
        'user_wechat',
        'img_profile',
        'img_user',
        'user_email',
        'email_verified_at',
        'user_type',
        'password',
        'remember_token',
        'created_at', 'updated_at',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
