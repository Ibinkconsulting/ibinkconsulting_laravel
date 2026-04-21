<?php

namespace App\Http\Controllers\Web\backend\CMS\MasterClassPage;


use App\Enums\Page;
use App\Enums\Section;
use App\Helper\Helper;


use App\Http\Controllers\Controller;

use App\Http\Requests\CMS\MasterClass\MasterclassSectionRequest;
use App\Models\CMS;
use App\Traits\apiresponse;
use Exception;
use getID3;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class MasterClassPageController extends Controller
{
    use apiresponse;



    // Masterclass Section =====================================================
    public function masterclassSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::MasterClassPage,
            'section' => Section::MasterclassSection,
        ]);

        return view('backend.layout.cms.masterclass_page.masterclass_section', compact('data'));
    }

    public function masterclassSectionUpdate(MasterclassSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::MasterClassPage,
                'section' => Section::MasterclassSection,
            ]);

            // Update basic fields
            $data->title = $request->title;
            $data->sub_title = $request->sub_title;
            $data->description = $request->description;
            $data->button_text = $request->button_text;

            // Handle Video Upload
            if ($request->hasFile('video') && $request->file('video')->isValid()) {
                $file = $request->file('video');
                $nameForFile = $request->title ? Str::slug($request->title) . '-' . time() : 'masterclass-video-' . time();
                $uploadedPath = Helper::videoUpload($file, 'videos', $nameForFile);

                $fullPath = public_path($uploadedPath);

                // Calculate video duration
                $durationSeconds = 0;
                try {
                    $getID3 = new getID3;
                    $fileInfo = $getID3->analyze($fullPath);
                    if (!empty($fileInfo['playtime_seconds'])) {
                        $durationSeconds = (int) round($fileInfo['playtime_seconds']);
                    }
                } catch (Exception $e) {
                    Log::warning("Could not detect duration for video: " . $e->getMessage());
                }

                // Delete old video
                if ($data->video && file_exists(public_path($data->video))) {
                    @unlink(public_path($data->video));
                }

                $data->video = $uploadedPath;
                $data->duration = $durationSeconds;
            }
            // Save to database
            $data->save();

            return redirect()->back()->with('notify-success', 'Masterclass section updated successfully!');

        } catch (Exception $e) {
            Log::error('Masterclass section update failed: ' . $e->getMessage());

            // Delete uploaded video if error occurs
            if (isset($uploadedPath) && file_exists(public_path($uploadedPath))) {
                @unlink(public_path($uploadedPath));
            }

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }



}