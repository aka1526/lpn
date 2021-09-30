<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberrenews extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "renew_uid";
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    public $table = 'memberrenews';

    protected $fillable = [
        'renew_uid'
        , 'renew_maxno'
        , 'renew_member_uid'
        , 'renew_member_no'
        , 'renew_member_fullname'
        , 'renew_price'
        , 'khan_uid'
        , 'khan_no'
        , 'khan_name'
        , 'renew_year'
        , 'renew_month'
        , 'renew_date_issue'
        ,'renew_date_exp'
        , 'card_img'
        , 'renew_status'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'

    ];

     
}
