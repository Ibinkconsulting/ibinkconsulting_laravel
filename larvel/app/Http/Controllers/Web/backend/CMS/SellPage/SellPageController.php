<?php

namespace App\Http\Controllers\Web\backend\CMS\SellPage;

use App\Enums\Page;
use App\Enums\Section;
use App\Helper\Helper;
use App\Http\Controllers\Controller;


use App\Http\Requests\CMS\Sell\SellPageBuyingProcessSectionRequest;
use App\Http\Requests\CMS\Sell\SellPageBuyingPropertySectionRequest;
use App\Http\Requests\CMS\Sell\SellPageChallengingSectionRequest;
use App\Http\Requests\CMS\Sell\SellPageCostConsiderBuyingPropertySectionRequest;
use App\Http\Requests\CMS\Sell\SellPageCostConsiderSellingPropertySectionRequest;
use App\Http\Requests\CMS\Sell\SellPageGetClaritySectionRequest;
use App\Http\Requests\CMS\Sell\SellPagePropertyChooseSectionRequest;
use App\Http\Requests\CMS\Sell\SellPageSellingProcessSectionRequest;
use App\Http\Requests\CMS\Sell\SellPageSellingPropertySectionRequest;
use App\Http\Requests\CMS\Sell\SellPageTopSectionRequest;
use App\Http\Requests\CMS\Sell\SellPageWorkWithUsSectionRequest;
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

class SellPageController extends Controller
{
    use apiresponse;

    // Top Section ==========================================================================
    public function topSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::SellPage,
            'section' => Section::TopSection,
        ]);

        return view('backend.layout.cms.sell_page.top_section', compact('data'));
    }

    public function topSectionUpdate(SellPageTopSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::SellPage,
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
    public function sellingPropertySection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::SellPage,
            'section' => Section::SellingPropertySection,
        ]);

        return view('backend.layout.cms.sell_page.selling_property_section', compact('data'));
    }

    public function sellingPropertySectionUpdate(SellPageSellingPropertySectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::SellPage,
                'section' => Section::SellingPropertySection,
            ]);

            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();

            return redirect()->back()->with('notify-success', 'Selling property section updated successfully');

        } catch (Exception $e) {
            Log::error('Selling property section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }

    // Challenging Section =====================================================
    public function challengingSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::SellPage,
            'section' => Section::ChallengingSection,
        ]);

        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.sell_page.challenging_section', compact('data', 'parts'));
    }

    public function challengingSectionUpdate(SellPageChallengingSectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::SellPage,
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


    // Property Choose Section =====================================================
    public function propertyChooseSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::SellPage,
            'section' => Section::PropertyChooseSection,
        ]);

        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.sell_page.property_choose_section', compact('data', 'parts'));
    }

    public function propertyChooseSectionUpdate(SellPagePropertyChooseSectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::SellPage,
                'section' => Section::PropertyChooseSection,
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

            return redirect()->back()->with('notify-success', 'Property choose section updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Property choose section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }

    // Selling Process Section =====================================================
    public function sellingProcessSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::SellPage,
            'section' => Section::SellingProcessSection,
        ]);

        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.sell_page.selling_process_section', compact('data', 'parts'));
    }

    public function sellingProcessSectionUpdate(SellPageSellingProcessSectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::SellPage,
                'section' => Section::SellingProcessSection,
            ]);

            $data->main_text = trim($request->main_text ?? '');
            $data->sub_text = trim($request->sub_text ?? '');

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

            return redirect()->back()->with('notify-success', 'Selling process section updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Selling process section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }

    // Cost Consider Buying Property Section =======================================
    public function costConsiderSellingPropertySection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::SellPage,
            'section' => Section::CostConsiderSellingPropertySection,
        ]);
        $parts = $data->v1 ? json_decode($data->v1, true) : [];

        return view('backend.layout.cms.sell_page.cost_consider_selling_property_section', compact('data', 'parts'));
    }

    public function costConsiderSellingPropertySectionUpdate(SellPageCostConsiderSellingPropertySectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = CMS::firstOrNew([
                'page' => Page::SellPage,
                'section' => Section::CostConsiderSellingPropertySection,
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

            return redirect()->back()->with('notify-success', 'Cost consider section updated successfully');

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
            'page' => Page::SellPage,
            'section' => Section::GetClaritySection,
        ]);

        return view('backend.layout.cms.sell_page.get_clarity_section', compact('data'));
    }

    public function getClaritySectionUpdate(SellPageGetClaritySectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::SellPage,
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