<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailsends extends Model
{
    use HasFactory;

    protected $primaryKey = "send_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'mailsends';

    protected $fillable = [
        'send_uid'
        , 'send_email'
        , 'send_uid_subject'
        , 'send_subject'
        , 'send_type'
        , 'send_status'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'
    ];
}

 