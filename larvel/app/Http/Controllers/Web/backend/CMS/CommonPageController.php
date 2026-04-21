<?php

namespace App\Http\Controllers\Web\backend\CMS;

use App\Enums\Page;
use App\Enums\Section;
use App\Helper\Helper;
use App\Http\Controllers\Controller;

use App\Http\Requests\CMS\Common\AboutOwnerSectionRequest;
use App\Http\Requests\CMS\Common\AboutPertnershipSectionRequest;
use App\Http\Requests\CMS\Common\AdvisorSectionRequest;
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

class CommonPageController extends Controller
{
    use apiresponse;


    // About Owner Section =====================================================
    public function aboutOwnerSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::CommonPage,
            'section' => Section::AboutOwnerSection,
        ]);

        return view('backend.layout.cms.common_page.about_owner_section', compact('data'));
    }

    public function aboutOwnerSectionUpdate(AboutOwnerSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::CommonPage,
                'section' => Section::AboutOwnerSection,
            ]);

            $data->title = $request->title;
            $data->sub_description = $request->sub_description;
            $data->description = $request->description;
            $data->button_text = $request->button_text;
            $data->link_url = $request->link_url;

            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $file = $request->file('logo');
                $nameForFile = $request->title ? Str::slug($request->title) . '-logo-' . time() : 'about-owner-logo-' . time();
                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile); // ✅ Changed to fileUpload

                // Delete old logo
                if ($data->logo && file_exists(public_path($data->logo))) {
                    @unlink(public_path($data->logo));
                }

                $data->logo = $uploadedPath;
            }

            // Image upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $nameForFile = $request->title ? Str::slug($request->title) . '-image-' . time() : 'about-owner-image-' . time();
                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile); // ✅ Changed to fileUpload

                // Delete old image
                if ($data->image && file_exists(public_path($data->image))) {
                    @unlink(public_path($data->image));
                }

                $data->image = $uploadedPath;
            }

            if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
                $file = $request->file('icon');
                $nameForFile = $request->title ? Str::slug($request->title) . '-icon-' . time() : 'about-owner-icon-' . time();
                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile); // ✅ Changed to fileUpload

                // Delete old icon
                if ($data->icon && file_exists(public_path($data->icon))) {
                    @unlink(public_path($data->icon));
                }

                $data->icon = $uploadedPath;
            }

            $data->save();

            return redirect()->back()->with('notify-success', 'About Owner section updated successfully');

        } catch (Exception $e) {
            Log::error('About Owner section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }



    // About Pertnership Section =====================================================
    public function aboutPertnershipSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::CommonPage,
            'section' => Section::AboutPertnershipSection,
        ]);

        return view('backend.layout.cms.common_page.about_pertnership_section', compact('data'));
    }

    public function aboutPertnershipSectionUpdate(AboutPertnershipSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::CommonPage,
                'section' => Section::AboutPertnershipSection,
            ]);

            $data->title = $request->title;
            $data->description = $request->description;

            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $file = $request->file('logo');
                $nameForFile = $request->title ? Str::slug($request->title) . '-logo-' . time() : 'about-pertnership-logo-' . time();
                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile); // ✅ Changed to fileUpload

                // Delete old logo
                if ($data->logo && file_exists(public_path($data->logo))) {
                    @unlink(public_path($data->logo));
                }

                $data->logo = $uploadedPath;
            }

            // Image upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $nameForFile = $request->title ? Str::slug($request->title) . '-image-' . time() : 'about-pertnership-image-' . time();
                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile); // ✅ Changed to fileUpload

                // Delete old image
                if ($data->image && file_exists(public_path($data->image))) {
                    @unlink(public_path($data->image));
                }

                $data->image = $uploadedPath;
            }

            $data->save();

            return redirect()->back()->with('notify-success', 'About Pertnership section updated successfully');

        } catch (Exception $e) {
            Log::error('About Pertnership section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }



    // Advisor Section =====================================================================
    public function advisorSection()
    {
        $data = CMS::firstOrNew([
            'page' => Page::CommonPage,
            'section' => Section::AdvisorSection,
        ]);

        return view('backend.layout.cms.common_page.advisor_section', compact('data'));
    }

    public function advisorSectionUpdate(AdvisorSectionRequest $request)
    {
        try {
            $data = CMS::firstOrNew([
                'page' => Page::CommonPage,
                'section' => Section::AdvisorSection,
            ]);

            $data->title = $request->title;

            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $file = $request->file('logo');
                $nameForFile = $request->title ? Str::slug($request->title) . '-logo-' . time() : 'advisor-logo-' . time();
                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile); // ✅ Changed to fileUpload

                // Delete old logo
                if ($data->logo && file_exists(public_path($data->logo))) {
                    @unlink(public_path($data->logo));
                }

                $data->logo = $uploadedPath;
            }

            $data->save();

            return redirect()->back()->with('notify-success', 'Advisor section updated successfully');

        } catch (Exception $e) {
            Log::error('Advisor section update failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('notify-error', 'Error: ' . $e->getMessage());
        }
    }


}