<?php

namespace App\Http\Controllers\Web\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSettingUpdateRequest;
use App\Http\Requests\GeneralSettingStoreRequest;
use App\Http\Requests\SocialMediaUpdateRequest;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public $settingServiceObj;

    public function __construct()
    {
        $this->settingServiceObj = new SettingService();
    }


    public function adminSetting()
    {
        return $this->settingServiceObj->adminSettingPage();
    }

    public function adminSettingUpdate(AdminSettingUpdateRequest $request)
    {
        $title = $request->input('title');
        $code = $request->input('phone_code');
        $phone = $request->input('phone_number');
        $email = $request->input('email');
        $copyright = $request->input('copyright');
        $footer_text = $request->input('footer_text');
        $office_time = $request->input('office_time');
        $address = $request->input('address');


        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
        } else {
            $logo = null;
        }
        if ($request->hasFile('white_logo')) {
            $white_logo = $request->file('white_logo');
        } else {
            $white_logo = null;
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
        } else {
            $favicon = null;
        }



        return $this->settingServiceObj->adminSettingUpdate($title, $logo, $favicon, $white_logo, $code, $phone, $email, $copyright, $footer_text, $office_time, $address);
    }


    public function socialMedia()
    {
        return $this->settingServiceObj->socialMediaPage();
    }

    public function socialMediaUpdate(Request $request)
    {
        $data = $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        return $this->settingServiceObj->socialMediaUpdate($data);
    }
}
