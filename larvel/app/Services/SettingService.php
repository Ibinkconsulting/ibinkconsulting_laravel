<?php

namespace App\Services;

use App\Models\SocialMedia;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingService extends Service
{
    public function adminSettingPage()
    {
        $data['setting'] = SystemSetting::firstOrCreate([]);
        return view('backend.layout.setting.system-setting', $data);
    }

    public function adminSettingUpdate($title, $logo, $favicon, $white_logo, $code, $phone, $email, $copyright, $footer_text, $office_time, $address)
    {
        try {
            DB::beginTransaction();
            $setting = SystemSetting::firstOrNew();
            $setting->title = Str::title($title);
            $setting->phone_code = $code;
            $setting->phone_number = $phone;
            $setting->email = $email;

            if ($logo != null) {
                $path = $this->fileUpload($logo, 'systems/logo/');
                $setting->logo = $path;
            }
            if ($white_logo != null) {
                $whitepath = $this->fileUpload($white_logo, 'systems/logo/');
                $setting->white_logo = $whitepath;
            }

            if ($favicon != null) {
                $path = $this->fileUpload($favicon, 'systems/favicon/');
                $setting->favicon = $path;
            }

            $setting->copyright = $copyright;
            $setting->footer_text = $footer_text;
            $setting->office_time = $office_time;
            $setting->address = $address;

            $res = $setting->save();

            DB::commit();
            if ($res) {
                return redirect()->back()->with('message', 'Update information successfully');
            }
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function socialMediaPage()
    {
        $platforms = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube'];

        $socials = SocialMedia::whereIn('platform', $platforms)
            ->pluck('url', 'platform')
            ->toArray();

        $data['socials'] = $socials;
        $data['platforms'] = $platforms;

        return view('backend.layout.setting.social-media', $data);
    }

    public function socialMediaUpdate(array $input)
    {
        try {
            DB::beginTransaction();

            foreach ($input as $platform => $url) {
                if (trim($url) === '') {
                    SocialMedia::where('platform', $platform)->delete();
                    continue;
                }

                SocialMedia::updateOrCreate(
                    ['platform' => $platform],
                    ['url' => trim($url)]
                );
            }

            DB::commit();
            return redirect()->back()->with('message', 'Social media links updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
}
