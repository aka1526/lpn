<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "cer_no";
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    public $table = 'certificates';

    protected $fillable = [
        'cer_uid'
        , 'cer_no'
        , 'cer_maxno'
        , 'cer_year'
        , 'cer_month'
        , 'cer_date_issue'
        , 'cer_date_exp'
        , 'khan_uid'
        , 'khan_no'
        , 'khan_name'
        , 'cer_member_uid'
        , 'cer_member_no'
        , 'cer_member_fullname'
        , 'created_by'
        , 'created_at'
        , 'updated_at'

    ];

     
}
