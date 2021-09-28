<?php

namespace App\Models\Admins;

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
    protected $primaryKey = "member_uid";
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    public $table = 'members';

    protected $fillable = [
        'member_uid'
        , 'first_name'
        , 'last_name'
        , 'full_name'
        , 'gender'
        , 'dateofbirth'
        , 'user_tel'
        , 'khan_uid'
        , 'khan_no'
        , 'khan_name'
        , 'certificate_no'
        , 'kru_uid', 'under_kru'
        , 'club_name'
        , 'user_address'
        , 'country_code'
        , 'country_name'
        , 'user_facebook'
        , 'user_ig'
        , 'user_wechat'
        , 'img_profile'
        , 'img_certificate'
        , 'img_user'
        , 'user_email'
        , 'email_verified_at'
        , 'user_type'
        , 'password'
        , 'remember_token'
        , 'created_at'
        , 'updated_at'
        , 'member_status'
        , 'date_expiry'
        , 'date_renew'
        , 'member_group'
        , 'member_active'
        , 'max_no'
        , 'member_year'
        , 'member_month'
        , 'member_no'
        , 'last_login_uid'
        , 'last_login_date'
        ,'member_www'
        ,'date_register'
        ,'img_idcard'
        ,'isdelete'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
