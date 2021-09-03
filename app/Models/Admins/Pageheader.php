<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pageheader extends Model
{
    use HasFactory;
    protected $primaryKey = "pageheader_uid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'pageheader';

    protected $fillable = [
         'pageheader_uid'
         , 'pageheader_type'
         , 'pageheader_title'
         , 'pageheader_header'
         , 'pageheader_detail'
         , 'pageheader_status'
         , 'created_at'
         , 'updated_at'

    ];
}
