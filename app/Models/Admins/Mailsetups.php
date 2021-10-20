<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailsetups extends Model
{
    use HasFactory;

    protected $primaryKey = "email_address";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'mailsetups';

    protected $fillable = [
        'mail_uid'
        , 'mail_index'
        , 'email_from'
        , 'email_from_alia'
        , 'email_address'
        , 'email_password'
        , 'smtp_host'
        , 'smtp_port'
        , 'smtp_secure'
        , 'smtp_auth'
        , 'email_smtp'
        , 'email_smtp_ssl'
        , 'email_smtp_server'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'
    ];
}

 