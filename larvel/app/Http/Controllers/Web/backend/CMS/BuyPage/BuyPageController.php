<?php

namespace App\Http\Controllers\Web\backend\CMS\BuyPage;

use App\Enums\Page;
use App\Enums\Section;
use App\Helper\Helper;
use App\Http\Controllers\Controller;


use App\Http\Requests\CMS\Buy\BuyPageBuyingProcessSectionRequest;
use App\Http\Requests\CMS\Buy\BuyPageBuyingPropertySectionRequest;
use App\Http\Requests\CMS\Buy\BuyPageChallengingSectionRequest;
use App\Http\Requests\CMS\Buy\BuyPageCostConsiderBuyingPropertySectionRequest;
use App\Http\Requests\CMS\Buy\BuyPageGetClaritySectionRequest;
use App\Http\Requests\CMS\Buy\BuyPageTopSectionRequest;
use App\Http\Requests\CMS\Buy\BuyPageWorkWithUsSectionRequest;
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

class BuyPageController extends Controller
{
    use apiresponse;

    // Top Section ==========================================================================
    public function topSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::BuyPage,
            'section' => Section::TopSection,
        ]);

        return view('backend.layout.cms.buy_page.top_section', compact('data'));
    }

    public function topSectionUpdate(BuyPageTopSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::BuyPage,
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

    // Buying Property Section =====================================================
    public function buyingPropertySection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::BuyPage,
            'section' => Section::BuyingPropertySection,
        ]);

        return view('backend.layout.cms.buy_page.buying_property_section', compact('data'));
    }

    public function buyingPropertySectionUpdate(BuyPageBuyingPropertySectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::BuyPage,
                'section' => Section::BuyingPropertySection,
            ]);

            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();

            return redirect()->back()->with('notify-success', 'Buying property section updated successfully');

        } catch (Exception $e) {
            Log::error('Buying property section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }

    // Challenging Section =====================================================
    public function challengingSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::BuyPage,
            'section' => Section::ChallengingSection,
        ]);

        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.buy_page.challenging_section', compact('data', 'parts'));
    }

    public function challengingSectionUpdate(BuyPageChallengingSectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::BuyPage,
                'section' => Section::ChallengingSection,
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

            return redirect()->back()->with('notify-success', 'Challenging section updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Challenging section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }


    // Work With Us Section =====================================================
    public function workWithUsSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::BuyPage,
            'section' => Section::WorkWithUsSection,
        ]);

        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.buy_page.work_with_us_section', compact('data', 'parts'));
    }

    public function workWithUsSectionUpdate(BuyPageWorkWithUsSectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::BuyPage,
                'section' => Section::WorkWithUsSection,
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

            return redirect()->back()->with('notify-success', 'Work with us section updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Work with us section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }

    // Buying Process Section =====================================================
    public function buyingProcessSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::BuyPage,
            'section' => Section::BuyingProcessSection,
        ]);

        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.buy_page.buying_process_section', compact('data', 'parts'));
    }

    public function buyingProcessSectionUpdate(BuyPageBuyingProcessSectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::BuyPage,
                'section' => Section::BuyingProcessSection,
            ]);

            $data->main_text = trim($request->main_text ?? '');

            $data->button_text = trim($request->button_text ?? '');
            $data->link_url = trim($request->link_url ?? '');

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

            return redirect()->back()->with('notify-success', 'Buying process section updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Buying process section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }

    // Cost Consider Buying Property Section =======================================
    public function costConsiderBuyingPropertySection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::BuyPage,
            'section' => Section::CostConsiderBuyingPropertySection,
        ]);
        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.buy_page.cost_consider_buying_property_section', compact('data', 'parts'));
    }

    public function costConsiderBuyingPropertySectionUpdate(BuyPageCostConsiderBuyingPropertySectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::BuyPage,
                'section' => Section::CostConsiderBuyingPropertySection,
            ]);

            $data->main_text = trim($request->input('main_text') ?? '');
            $data->description = trim($request->input('description') ?? '');

            // Image handling
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $oldImage = $data->image;

                $file = $request->file('image');
                $name = Str::slug($request->input('main_text') ?: 'cost-consider') . '-' . time();
                $uploadedPath = Helper::fileUpload($file, 'cost-consider', $name);

                $data->image = $uploadedPath;

                if ($oldImage && file_exists(public_path($oldImage))) {
                    @unlink(public_path($oldImage));
                }
            }

            // Parts processing
            $parts = [];
            foreach ($request->input('parts', []) as $partInput) {
                $keyTitle = trim($partInput['key_title'] ?? '');

                $pointTitles = [];
                foreach ($partInput['points'] ?? [] as $pointInput) {
                    $pointTitle = trim($pointInput['point_title'] ?? '');
                    if ($pointTitle !== '') {
                        $pointTitles[] = ['point_title' => $pointTitle];
                    }
                }

                if ($keyTitle !== '' && !empty($pointTitles)) {
                    $parts[] = [
                        'key_title' => $keyTitle,
                        'points' => $pointTitles,
                    ];
                }
            }

            $data->v1 = json_encode($parts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $data->save();

            DB::commit();

            return redirect()->back()->with('notify-success', 'Cost consideration section updated successfully');

        } catch (Exception $e) {
            DB::rollBack();

            if (isset($uploadedPath) && file_exists(public_path($uploadedPath))) {
                @unlink(public_path($uploadedPath));
            }

            Log::error('Cost consider section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Update failed: ' . $e->getMessage());
        }
    }


    // Get Clarity Section =====================================================
    public function getClaritySection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::BuyPage,
            'section' => Section::GetClaritySection,
        ]);

        return view('backend.layout.cms.buy_page.get_clarity_section', compact('data'));
    }

    public function getClaritySectionUpdate(BuyPageGetClaritySectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::BuyPage,
                'section' => Section::GetClaritySection,
            ]);

            $data->title = $request->title;
            $data->description = $request->description;
            $data->button_text = $request->button_text;
            $data->link_url = $request->link_url;


            // Image upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $nameForFile = $request->title ? Str::slug($request->title) . '-image-' . time() : 'get-clarity-image-' . time();
                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile); // ✅ Changed to fileUpload

                // Delete old image
                if ($data->image && file_exists(public_path($data->image))) {
                    @unlink(public_path($data->image));
                }

                $data->image = $uploadedPath;
            }

            $data->save();

            return redirect()->back()->with('notify-success', 'Get Clarity section updated successfully');

        } catch (Exception $e) {
            Log::error('Get Clarity section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }



}