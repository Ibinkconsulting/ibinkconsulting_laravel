<?php
namespace App\Http\Controllers\Web\backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $status = $data->status;
                    return '<div class="form-check form-switch mb-2">
                                <input class="form-check-input" onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" ' . ($status == 'active' ? 'checked' : '') . '>
                            </div>';
                })
                ->addColumn('bulk_check', function ($data) {
                    return Helper::tableCheckbox($data->id);
                })
                ->addColumn('action', function ($data) {
                    $viewRoute = route('admin.category.edit', ['category' => $data->id]);
                    return '<div>
                         <a class="btn btn-sm btn-primary" href="' . $viewRoute . '">
                             <i class="fa-solid fa-pen"></i>
                         </a>
                         <button type="button" onclick="showDeleteAlert(' . $data->id . ')" class="btn btn-sm btn-danger">
                             <i class="fa-regular fa-trash-can"></i>
                         </button>
                     </div>';
                })
                ->rawColumns(['bulk_check', 'image', 'status', 'action'])
                ->make(true);
        }

        return view('backend.layout.category.index');
    }


    public function create()
    {
        return view('backend.layout.category.create');
    }


    public function store(CategoryRequest $request)
    {
        try {
            $category        = new Category();
            $category->title = $request->title;
            $category->slug  = Str::slug($request->validated('title'));

            $category->save();
            return redirect()->route('admin.category.index')->with('t-success', 'Category created successfully');
        } catch (Exception $exception) {
            return redirect()->route('admin.category.index')->with('t-error', $exception->getMessage());
        }
    }


    public function edit(Category $category)
    {
        return view('backend.layout.category.edit', compact('category'));
    }


    public function update(CategoryRequest $request)
    {
        try {
            $category        = Category::findOrFail($request->id);
            $category->title = $request->validated('title');
            $category->slug  = Str::slug($request->validated('title'));
            $category->save();
            return redirect()->route('admin.category.index')->with('t-success', 'Category updated successfully');
        } catch (Exception $exception) {
            return redirect()->route('admin.category.index')->with('t-error', 'Something went wrong');
        }
    }

    /**
     * Change the status of the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse
    {
        $data = Category::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        }
    }

    /**
     * Delete the specified resource from storage.
     * @param  Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * multiple user destroy resource
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        if ($request->ajax()) {
            $result = Category::whereIn('id', $request->ids)->get();

            if ($result) {
                Category::destroy($request->ids);
                return response()->json([
                    'success' => true,
                    'message' => 'Categories deleted successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Categories not found',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
}
