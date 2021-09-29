<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberkhans extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "row_uid";
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    public $table = 'memberkhans';

    protected $fillable = [
        'row_uid'
        ,'khan_uid'
        , 'khan_no'
        , 'khan_name'
        , 'cer_uid'
        , 'cer_no'
        , 'cer_maxno'
        , 'cer_year'
        , 'cer_month'
        , 'cer_date_issue'
        , 'cer_member_uid'
        , 'cer_member_no'
        , 'cer_member_fullname'
        , 'khan_status'
        , 'created_by'
        , 'created_at'
        , 'updated_at'

    ];

     
}
