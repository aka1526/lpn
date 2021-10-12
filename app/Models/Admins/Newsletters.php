<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletters extends Model
{
    use HasFactory;

    protected $primaryKey = "news_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'newsletters';

    protected $fillable = [
        'news_uid'
        , 'news_type'
        , 'news_title'
        , 'news_email'
        , 'news_name'
        , 'news_phone'
        , 'news_date'
        , 'news_message'
        , 'news_message_reply'
        ,'news_ref_uid'
        , 'news_by_ipaddress'
        , 'news_by_os'
        , 'news_member_id'
        , 'news_status'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'
    ];
}

 