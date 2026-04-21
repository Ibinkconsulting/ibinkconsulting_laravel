<?php

namespace App\Http\Controllers\Web\backend\CMS\HomePage;

use App\Enums\Page;
use App\Enums\Section;
use App\Helper\Helper;
use App\Http\Controllers\Controller;

use App\Http\Requests\CMS\Home\HomePageAboutOwnerSectionRequest;
use App\Http\Requests\CMS\Home\HomePageAboutPertnershipSectionRequest;
use App\Http\Requests\CMS\Home\HomePageAdvisorSectionRequest;
use App\Http\Requests\CMS\Home\HomePageComingSoonSectionRequest;
use App\Http\Requests\CMS\Home\HomePageMasterclassSectionRequest;
use App\Http\Requests\CMS\Home\HomePageMiddleFileSectionRequest;
use App\Http\Requests\CMS\Home\HomePageTopSectionRequest;
use App\Models\CMS;
use App\Traits\apiresponse;
use Exception;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use League\Flysystem\UnableToCheckFileExistence;

class HomePageController extends Controller
{
    use apiresponse;

    // Top Section ==========================================================================
    public function topSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::HomePage,
            'section' => Section::TopSection,
        ]);

        return view('backend.layout.cms.home_page.top_section', compact('data'));
    }

    public function topSectionUpdate(HomePageTopSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::HomePage,
                'section' => Section::TopSection,
            ]);

            $oldType = $data->type;
            $oldImage = $data->image;
            $oldVideo = $data->video;

            $data->title = $request->title;
            $data->sub_title = $request->sub_title;
            $data->type = $request->type;

            $shouldDeleteOldImage = false;
            $shouldDeleteOldVideo = false;

            if ($request->type === 'image') {
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $shouldDeleteOldImage = true;
                    $shouldDeleteOldVideo = true;

                    $file = $request->file('image');
                    $nameForFile = $request->title
                        ? Str::slug($request->title) . '-image-' . time()
                        : 'top-image-' . time();

                    $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile);
                    $data->image = $uploadedPath;
                }
                $data->video = null;
                $data->duration = null;
            } elseif ($request->type === 'video') {
                if ($request->hasFile('video') && $request->file('video')->isValid()) {
                    $shouldDeleteOldVideo = true;
                    $shouldDeleteOldImage = true;

                    $file = $request->file('video');
                    $nameForFile = $request->title
                        ? Str::slug($request->title) . '-' . time()
                        : 'top-video-' . time();

                    $uploadedPath = Helper::videoUpload($file, 'videos', $nameForFile);
                    $fullPath = public_path($uploadedPath);

                    // duration
                    $durationSeconds = 0;
                    try {
                        $getID3 = new getID3;
                        $fileInfo = $getID3->analyze($fullPath);
                        $durationSeconds = !empty($fileInfo['playtime_seconds'])
                            ? (int) round($fileInfo['playtime_seconds'])
                            : 0;
                    } catch (Exception $e) {
                        Log::warning("Video duration detection failed: " . $e->getMessage());
                    }

                    $data->video = $uploadedPath;
                    $data->duration = $durationSeconds;
                }
                $data->image = null;
            }

            if ($shouldDeleteOldImage && $oldImage && file_exists(public_path($oldImage))) {
                @unlink(public_path($oldImage));
            }
            if ($shouldDeleteOldVideo && $oldVideo && file_exists(public_path($oldVideo))) {
                @unlink(public_path($oldVideo));
            }

            $data->save();

            return redirect()->back()->with('notify-success', 'Top section updated successfully');

        } catch (Exception $e) {
            Log::error('Top section update failed: ' . $e->getMessage());

            if (isset($uploadedPath) && file_exists(public_path($uploadedPath))) {
                @unlink(public_path($uploadedPath));
            }

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }


    // Middle File Section =====================================================
    public function middleFileSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::HomePage,
            'section' => Section::MiddleFileSection,
        ]);

        return view('backend.layout.cms.home_page.middle_file_section', compact('data'));
    }

    public function middleFileSectionUpdate(HomePageMiddleFileSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::HomePage,
                'section' => Section::MiddleFileSection,
            ]);

            $oldType = $data->type;
            $oldImage = $data->image;
            $oldVideo = $data->video;

            $data->type = $request->type;

            $shouldDeleteOldImage = false;
            $shouldDeleteOldVideo = false;

            if ($request->type === 'image') {
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $shouldDeleteOldImage = true;
                    $shouldDeleteOldVideo = true;

                    $file = $request->file('image');
                    $nameForFile = $request->title
                        ? Str::slug($request->title) . '-image-' . time()
                        : 'middle-file-image-' . time();

                    $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile);
                    $data->image = $uploadedPath;
                }
                $data->video = null;
                $data->duration = null;
            } elseif ($request->type === 'video') {
                if ($request->hasFile('video') && $request->file('video')->isValid()) {
                    $shouldDeleteOldVideo = true;
                    $shouldDeleteOldImage = true;

                    $file = $request->file('video');
                    $nameForFile = $request->title
                        ? Str::slug($request->title) . '-' . time()
                        : 'top-video-' . time();

                    $uploadedPath = Helper::videoUpload($file, 'videos', $nameForFile);
                    $fullPath = public_path($uploadedPath);

                    // duration
                    $durationSeconds = 0;
                    try {
                        $getID3 = new getID3;
                        $fileInfo = $getID3->analyze($fullPath);
                        $durationSeconds = !empty($fileInfo['playtime_seconds'])
                            ? (int) round($fileInfo['playtime_seconds'])
                            : 0;
                    } catch (Exception $e) {
                        Log::warning("Video duration detection failed: " . $e->getMessage());
                    }

                    $data->video = $uploadedPath;
                    $data->duration = $durationSeconds;
                }
                $data->image = null;
            }

            if ($shouldDeleteOldImage && $oldImage && file_exists(public_path($oldImage))) {
                @unlink(public_path($oldImage));
            }
            if ($shouldDeleteOldVideo && $oldVideo && file_exists(public_path($oldVideo))) {
                @unlink(public_path($oldVideo));
            }

            $data->save();

            return redirect()->back()->with('notify-success', 'Middle File section updated successfully');

        } catch (Exception $e) {
            Log::error('Middle File section update failed: ' . $e->getMessage());

            if (isset($uploadedPath) && file_exists(public_path($uploadedPath))) {
                @unlink(public_path($uploadedPath));
            }

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }


    // Coming Soon Section =====================================================
    public function comingSoonSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::HomePage,
            'section' => Section::ComingSoonSection,
        ]);

        return view('backend.layout.cms.home_page.coming_soon_section', compact('data'));
    }

    public function comingSoonSectionUpdate(HomePageComingSoonSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::HomePage,
                'section' => Section::ComingSoonSection,
            ]);

            $data->title = $request->title;
            $data->sub_title = $request->sub_title;
            $data->button_text = $request->button_text;
            $data->link_url = $request->link_url;

            $oldType = $data->type;
            $oldImage = $data->image;
            $oldVideo = $data->video;

            $data->type = $request->type;

            $shouldDeleteOldImage = false;
            $shouldDeleteOldVideo = false;

            if ($request->type === 'image') {
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $shouldDeleteOldImage = true;
                    $shouldDeleteOldVideo = true;

                    $file = $request->file('image');
                    $nameForFile = $request->title
                        ? Str::slug($request->title) . '-image-' . time()
                        : 'middle-file-image-' . time();

                    $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile);
                    $data->image = $uploadedPath;
                }
                $data->video = null;
                $data->duration = null;
            } elseif ($request->type === 'video') {
                if ($request->hasFile('video') && $request->file('video')->isValid()) {
                    $shouldDeleteOldVideo = true;
                    $shouldDeleteOldImage = true;

                    $file = $request->file('video');
                    $nameForFile = $request->title
                        ? Str::slug($request->title) . '-' . time()
                        : 'top-video-' . time();

                    $uploadedPath = Helper::videoUpload($file, 'videos', $nameForFile);
                    $fullPath = public_path($uploadedPath);

                    // duration
                    $durationSeconds = 0;
                    try {
                        $getID3 = new getID3;
                        $fileInfo = $getID3->analyze($fullPath);
                        $durationSeconds = !empty($fileInfo['playtime_seconds'])
                            ? (int) round($fileInfo['playtime_seconds'])
                            : 0;
                    } catch (Exception $e) {
                        Log::warning("Video duration detection failed: " . $e->getMessage());
                    }

                    $data->video = $uploadedPath;
                    $data->duration = $durationSeconds;
                }
                $data->image = null;
            }

            if ($shouldDeleteOldImage && $oldImage && file_exists(public_path($oldImage))) {
                @unlink(public_path($oldImage));
            }
            if ($shouldDeleteOldVideo && $oldVideo && file_exists(public_path($oldVideo))) {
                @unlink(public_path($oldVideo));
            }

            $data->save();

            return redirect()->back()->with('notify-success', 'Coming Soon section updated successfully');

        } catch (Exception $e) {
            Log::error('Coming Soon section update failed: ' . $e->getMessage());

            if (isset($uploadedPath) && file_exists(public_path($uploadedPath))) {
                @unlink(public_path($uploadedPath));
            }

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }


}