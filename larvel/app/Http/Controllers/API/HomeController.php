<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use App\Models\Category;
use App\Models\Property;
use App\Models\SocialMedia;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use App\Http\Resources\FooterResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PerPropertyResource;

class HomeController extends Controller
{
    use apiresponse;


    public function getCategories()
    {
        $categories = Category::get();

        return $this->success(CategoryResource::collection($categories), 'Categories fetched successfully', 200);
    }

    public function getArticles(Request $request)
    {
        $query = Article::query()
            ->with('category')
            ->where('status', 'active')
            ->orderBy('year', 'desc')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        // Filter by category if provided
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $articles = $query->get();

        return $this->success(ArticleResource::collection($articles), 'Articles fetched successfully', 200);
    }

    public function featuredProperties(Request $request)
    {
        $query = Property::query()
            ->where('availability', 'available')
            ->where('status', 'active')
            ->with(['thumbnail', 'amenities']);

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }

        if ($request->filled('apartment_type')) {
            $query->where('apartment_type', $request->apartment_type);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $properties = $query->paginate(9);

        return response()->json([
            'success' => true,
            'message' => 'Properties fetched successfully',
            'data' => PropertyResource::collection($properties),
            'meta' => [
                'current_page' => $properties->currentPage(),
                'last_page' => $properties->lastPage(),
                'per_page' => $properties->perPage(),
                'total' => $properties->total(),
            ],
            'links' => [
                'next' => $properties->nextPageUrl(),
                'prev' => $properties->previousPageUrl(),
            ],
        ], 200);
    }

    public function perProperty($slug)
    {
        $property = Property::where('availability', 'available')
            ->where('slug', $slug)
            ->with(['thumbnail', 'files', 'amenities'])
            ->firstOrFail();

        return $this->success(
            new PerPropertyResource($property),
            'Property fetched successfully',
            200
        );
    }

    public function footer()
    {
        $systemSetting = SystemSetting::select([
            'white_logo',
            'footer_text',
            'copyright',
            'phone_code',
            'phone_number',
            'email'
        ])->first();

        $socialMedia = SocialMedia::select('platform', 'url')
            ->whereNotNull('url')
            ->where('url', '!=', '')
            ->get();

        $footerData = [
            'system_setting' => $systemSetting,
            'social_media' => $socialMedia,
        ];

        return $this->success(
            new FooterResource($footerData),
            'Footer data fetched successfully',
            200
        );
    }
}
