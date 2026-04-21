<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\CoreAmenity;
use App\Models\Property;
use App\Models\PropertyFile;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Property::with('thumbnail')->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {

                    if (!$data->thumbnail) {
                        return 'N/A';
                    }

                    return '<img src="' . asset($data->thumbnail->file_path) . '" 
                        width="100" 
                        class="img-thumbnail">';
                })
                ->addColumn('width', function ($data) {
                    return $data->floor_size . ' M<sup>2</sup>';
                })
                ->addColumn('price', function ($data) {
                    return '$' . $data->price;
                })
                ->addColumn('availability', function ($data) {
                    return '<div class="form-group mt-2">
                                <select name="availiability" class="form-control" onchange="changeAvailability(this, ' . $data->id . ')" data-id="' . $data->id . '">
                                    <option value="available" ' . ($data->availability == 'available' ? 'selected' : '') . '>Available</option>
                                    <option value="unavailable" ' . ($data->availability == 'unavailable' ? 'selected' : '') . '>Unavailable</option>
                                </select>
                            </div>';
                })
                ->addColumn('status', function ($data) {
                    $status = $data->status;

                    return '<div class="form-check form-switch mb-2">
                                <input class="form-check-input" onclick="showStatusChangeAlert(event,' . $data->id . ')" type="checkbox" ' . ($status == 'active' ? 'checked' : '') . '>
                            </div>';

                })
                ->addColumn('bulk_check', function ($data) {
                    return Helper::tableCheckbox($data->id);

                })
                ->addColumn('action', function ($data) {
                    return '<div>
                         <a class="btn btn-sm btn-primary" href="' . route('admin.property.edit', ['property' => $data->id]) . '">
                             <i class="fa-solid fa-pencil"></i>
                         </a>
                         <button type="button" onclick="deleteRecord(' . $data->id . ')" class="btn btn-sm btn-danger">
                             <i class="fa-solid fa-trash"></i>
                         </button>
                     </div>';
                })
                ->rawColumns(['image', 'availability', 'width', 'price', 'bulk_check', 'status', 'action'])
                ->make(true);
        }

        return view('backend.layout.properties.index');
    }

    public function create()
    {

        return view('backend.layout.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @praram Request $request
     *
     * @return View
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Invalid request']);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:200',
            'price' => 'required|numeric',
            'city' => 'required|string',
            'apartment_type' => 'required|in:rent,lease',
            'bedrooms' => 'required|numeric|min:0',
            'bathrooms' => 'required|numeric|min:0',
            'garages' => 'nullable|numeric|min:0',
            'open_spaces' => 'nullable|numeric|min:0',
            'land_size' => 'nullable|numeric|min:0',
            'floor_size' => 'nullable|numeric|min:0',
            'establishment_year' => 'nullable|string|max:10',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'ground_plan' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'first_plan' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
                'code' => 422,
            ]);
        }

        DB::beginTransaction();

        try {
            // Upload floor plans
            $groundPlanPath = Helper::fileUpload($request->file('ground_plan'), 'properties', time() . '_ground_' . uniqid() . '.' . $request->file('ground_plan')->getClientOriginalExtension());
            $firstPlanPath = Helper::fileUpload($request->file('first_plan'), 'properties', time() . '_first_' . uniqid() . '.' . $request->file('first_plan')->getClientOriginalExtension());

            // Create property
            $property = Property::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'location' => $request->location,
                'price' => $request->price,
                'city' => $request->city,
                'apartment_type' => $request->apartment_type,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'garages' => $request->garages ?? 0,
                'open_spaces' => $request->open_spaces ?? 0,
                'land_size' => $request->land_size,
                'floor_size' => $request->floor_size,
                'establishment_year' => $request->establishment_year,
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'ground_plan' => $groundPlanPath,
                'first_plan' => $firstPlanPath,
            ]);

            // Thumbnail
            if ($request->hasFile('thumbnail')) {
                $thumbPath = Helper::fileUpload($request->file('thumbnail'), 'properties', time() . '_thumb_' . uniqid() . '.' . $request->file('thumbnail')->getClientOriginalExtension());
                PropertyFile::create([
                    'property_id' => $property->id,
                    'file_path' => $thumbPath,
                    'is_primary' => true,
                ]);
            }

            // Gallery images
            foreach ($request->file('images', []) as $image) {
                $imgPath = Helper::fileUpload($image, 'properties', time() . '_img_' . uniqid() . '.' . $image->getClientOriginalExtension());
                PropertyFile::create([
                    'property_id' => $property->id,
                    'file_path' => $imgPath,
                    'is_primary' => false,
                ]);
            }

            // ── Core Amenities ────────────────────────────────────────
            $amenities = $this->collectAmenitiesFromRequest($request);

            if (!empty($amenities)) {
                $amenityModels = collect($amenities)->map(function ($item) {
                    return new CoreAmenity([
                        'title' => $item['name'],
                        'icon' => $item['icon'],
                        'status' => 'active',
                    ]);
                });
                $property->amenities()->saveMany($amenityModels);
            }
            // ─────────────────────────────────────────────────────────

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Property created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Property store failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return View
     */
    public function edit(Property $property)
    {
        $property = Property::with('files', 'thumbnail', 'amenities')->findOrFail($property->id);

        $amenities = $property->amenities->map(function ($amenity) {
            $icon = $amenity->icon ?? '';

            $cleanIcon = trim($icon);
            $cleanIcon = preg_replace('/\s*<svg/', '<svg', $cleanIcon);     // leading space before <svg
            $cleanIcon = preg_replace('/<\/svg>\s*$/', '</svg>', $cleanIcon); // trailing after </svg>
            $cleanIcon = preg_replace('/[^>]\s*$/', '', $cleanIcon);        // শেষের যেকোনো non-tag char

            return [
                'name' => $amenity->title,
                'icon' => $cleanIcon,
            ];
        });

        return view('backend.layout.properties.edit', compact('property', 'amenities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return View
     */
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:200',
            'price' => 'required|numeric',
            'city' => 'required|string',
            'apartment_type' => 'required|in:rent,lease',
            'bedrooms' => 'required|numeric|min:0',
            'bathrooms' => 'required|numeric|min:0',
            'garages' => 'nullable|numeric|min:0',
            'open_spaces' => 'nullable|numeric|min:0',
            'land_size' => 'nullable|numeric|min:0',
            'floor_size' => 'nullable|numeric|min:0',
            'establishment_year' => 'nullable|string|max:10',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ground_plan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'first_plan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Update floor plans if uploaded
            if ($request->hasFile('ground_plan')) {
                if ($property->ground_plan && File::exists(public_path($property->ground_plan))) {
                    File::delete(public_path($property->ground_plan));
                }
                $property->ground_plan = Helper::fileUpload($request->file('ground_plan'), 'properties', time() . '_ground_' . uniqid() . '.' . $request->file('ground_plan')->getClientOriginalExtension());
            }

            if ($request->hasFile('first_plan')) {
                if ($property->first_plan && File::exists(public_path($property->first_plan))) {
                    File::delete(public_path($property->first_plan));
                }
                $property->first_plan = Helper::fileUpload($request->file('first_plan'), 'properties', time() . '_first_' . uniqid() . '.' . $request->file('first_plan')->getClientOriginalExtension());
            }

            $property->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'location' => $request->location,
                'price' => $request->price,
                'city' => $request->city,
                'apartment_type' => $request->apartment_type,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'garages' => $request->garages ?? 0,
                'open_spaces' => $request->open_spaces ?? 0,
                'land_size' => $request->land_size,
                'floor_size' => $request->floor_size,
                'establishment_year' => $request->establishment_year,
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            // Thumbnail replacement
            if ($request->hasFile('thumbnail')) {
                // Delete old
                $property->files()->where('is_primary', true)->delete();

                $path = Helper::fileUpload($request->file('thumbnail'), 'properties', time() . '_thumb_' . uniqid() . '.' . $request->file('thumbnail')->getClientOriginalExtension());
                PropertyFile::create([
                    'property_id' => $property->id,
                    'file_path' => $path,
                    'is_primary' => true,
                ]);
            }

            // Add new gallery images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = Helper::fileUpload($image, 'properties', time() . '_img_' . uniqid() . '.' . $image->getClientOriginalExtension());
                    PropertyFile::create([
                        'property_id' => $property->id,
                        'file_path' => $path,
                        'is_primary' => false,
                    ]);
                }
            }

            // ── Core Amenities ────────────────────────────────────────
            $amenities = $this->collectAmenitiesFromRequest($request);

            // Always clear old ones in update
            $property->amenities()->delete();

            if (!empty($amenities)) {
                $amenityModels = collect($amenities)->map(function ($item) {
                    return new CoreAmenity([
                        'title' => $item['name'],
                        'icon' => $item['icon'],
                        'status' => 'active',
                    ]);
                });
                $property->amenities()->saveMany($amenityModels);
            }
            // ─────────────────────────────────────────────────────────

            DB::commit();

            return redirect()->route('admin.property.index')
                ->with('success', 'Property updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Property update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    private function collectAmenitiesFromRequest(Request $request): array
    {
        $amenities = [];

        for ($i = 1; $i <= 100; $i++) {  // reasonable upper limit
            $nameKey = "amenity_{$i}_name";
            $iconKey = "amenity_{$i}_icon";

            $name = $request->input($nameKey);
            $icon = $request->input($iconKey);

            if (filled($name) && filled($icon)) {
                // Optional: clean the icon string (helps with highlighting issues)
                $cleanIcon = trim($icon);
                $cleanIcon = preg_replace('/\s*<\/svg>\s*$/', '</svg>', $cleanIcon);
                $cleanIcon = preg_replace('/^\s*<svg/', '<svg', $cleanIcon);

                $amenities[] = [
                    'name' => trim($name),
                    'icon' => $cleanIcon,
                ];
            }
        }

        return $amenities;
    }



    public function removeImage(Request $request)
    {
        $imageId = $request->input('image_id');
        $image = PropertyFile::find($imageId); // Assuming `PropertyImage` is your image model

        if ($image) {
            // Remove the image file from storage
            if (file_exists(public_path($image->file_path))) {
                unlink(public_path($image->file_path)); // Delete the image file
            }

            // Delete the image record from the database
            $image->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.']);
    }

    /**
     * Change the status of the specified resource.
     */
    public function status(int $id): JsonResponse
    {
        $data = Property::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data' => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data' => $data,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $property = Property::with(['thumbnail', 'files', 'amenities'])->find($id);

            if (!$property) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property not found.',
                ], 404);
            }

            /** Delete thumbnail image */
            if ($property->thumbnail && $property->thumbnail->file_path) {
                $thumbnailPath = public_path($property->thumbnail->file_path);

                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }

                $property->thumbnail->delete();
            }

            /** Delete property gallery files */
            if ($property->files && $property->files->count()) {
                foreach ($property->files as $file) {
                    $filePath = public_path($file->file_path);

                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }

                    $file->delete();
                }
            }

            $property->amenities()->delete();

            /** Delete property */
            $property->delete();

            return response()->json([
                'success' => true,
                'message' => 'Property deleted successfully.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Change availlability
     *
     * @return response
     */
    public function changeAvaillability($id, Request $request)
    {
        $valida = Validator::make($request->all(), [
            // 'availibility' => 'required|string|in: available,unavailable',
        ]);

        if ($valida->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Inputs',
                'error' => $valida->errors(),
            ]);
        }

        try {
            $property = Property::findOrFail($id);
            $property->availability = $request->availibility;
            $property->save();

            return response()->json([
                'success' => true,
                'message' => 'Changed',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }
}
