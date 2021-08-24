<?php

namespace App\Models\Admins;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Accessuid extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
 
    protected $primaryKey = "uid";
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    public $table = 'personal_access_uid';

    protected $fillable = [
        'uid',
        'uid_login',
        'last_used_at'
    
    ];


}
