<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
    use HasFactory;

    protected $primaryKey = "org_name";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'organizations';

    protected $fillable = [
        'org_uid'
        , 'org_type'
        , 'org_name'
        , 'org_name_th'
        , 'org_name_teachers'
        , 'org_country_uid'
        , 'org_country_name'
        , 'org_www'
        , 'org_email'
        , 'org_tel'
        , 'org_address'
        , 'org_facebook'
        , 'org_youtube'
        , 'org_instagram'
        , 'org_wechat'
        , 'org_profile'
        , 'org_date_register'
        , 'org_location_lat'
        , 'org_location_log'
        , 'org_date_validate'
        , 'org_date_exp'
        , 'org_logo'
        , 'org_card_id'
        , 'org_card_img'
        , 'org_certificate_no'
        , 'org_certificate_img'
        , 'org_status'
        , 'created_by'
        , 'updated_by'
        , 'created_at'
        , 'updated_at'
    ];
}

 