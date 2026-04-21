<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'title',
        'logo',
        'white_logo',
        'favicon',
        'phone_code',
        'phone_number',
        'email',
        'footer_text',
        'address',
        'office_time',
        'copyright_text',
    ];
}
