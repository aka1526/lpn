<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailsubscribe extends Model
{
    use HasFactory;

    protected $primaryKey = "email_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'mailsubscribe';

    protected $fillable = [
        'email_uid'
        , 'email_subject'
        , 'email_body'
        , 'email_status'
        ,'email_total'
        ,'email_send_total'
        , 'email_date_start'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'
    ];
}

 