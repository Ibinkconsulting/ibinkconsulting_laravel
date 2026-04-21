<?php

namespace App\Http\Controllers\Web\backend\CMS\AboutPage;

use App\Enums\Page;
use App\Enums\Section;
use App\Helper\Helper;
use App\Http\Controllers\Controller;

use App\Http\Requests\CMS\About\AboutPageAboutOwnerSectionRequest;
use App\Http\Requests\CMS\About\AboutPageAboutPertnershipSectionRequest;
use App\Http\Requests\CMS\About\AboutPageAboutUsSectionRequest;
use App\Http\Requests\CMS\About\AboutPageEndFileSectionRequest;
use App\Http\Requests\CMS\About\AboutPageOurValuesSectionRequest;
use App\Http\Requests\CMS\About\AboutPageTopSectionRequest;
use App\Http\Requests\CMS\Home\AboutPageComingSoonSectionRequest;
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

class AboutPageController extends Controller
{
    use apiresponse;

    // Top Section ==========================================================================
    public function topSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::AboutPage,
            'section' => Section::TopSection,
        ]);

        return view('backend.layout.cms.about_page.top_section', compact('data'));
    }

    public function topSectionUpdate(AboutPageTopSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::AboutPage,
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

    // About Us Section =====================================================
    public function aboutUsSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::AboutPage,
            'section' => Section::AboutUsSection,
        ]);

        return view('backend.layout.cms.about_page.about_us_section', compact('data'));
    }

    public function aboutUsSectionUpdate(AboutPageAboutUsSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::AboutPage,
                'section' => Section::AboutUsSection,
            ]);

            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();

            return redirect()->back()->with('notify-success', 'About us section updated successfully');

        } catch (Exception $e) {
            Log::error('About us section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }


    // Our Values Section =====================================================
    public function ourValuesSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::AboutPage,
            'section' => Section::OurValuesSection,
        ]);

        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.about_page.our_values_section', compact('data', 'parts'));
    }

    public function ourValuesSectionUpdate(AboutPageOurValuesSectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::AboutPage,
                'section' => Section::OurValuesSection,
            ]);

            $data->main_text = trim($request->main_text ?? '');

            $parts = [];
            foreach ($request->input('parts', []) as $part) {
                $parts[] = [
                    'title' => trim($part['title'] ?? ''),
                    'description' => trim($part['description'] ?? ''),
                ];
            }

            $data->v1 = json_encode($parts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $data->save();

            DB::commit();

            return redirect()->back()->with('notify-success', 'Our values section updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Our values section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }


    // End File Section =====================================================
    public function endFileSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::AboutPage,
            'section' => Section::EndFileSection,
        ]);

        return view('backend.layout.cms.about_page.end_file_section', compact('data'));
    }

    public function endFileSectionUpdate(AboutPageEndFileSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::AboutPage,
                'section' => Section::EndFileSection,
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
}