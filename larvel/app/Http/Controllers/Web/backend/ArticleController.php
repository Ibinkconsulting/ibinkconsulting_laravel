<?php
namespace App\Http\Controllers\Web\backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Article::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($data) {
                    return $data->category->title;
                })
                ->addColumn('status', function ($data) {
                    $status = $data->status;
                    return '<div class="form-check form-switch mb-2">
                                <input class="form-check-input" onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" ' . ($status == 'active' ? 'checked' : '') . '>
                            </div>';
                })
                ->addColumn('bulk_check', function ($data) {
                    return Helper::tableCheckbox($data->id);
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        $url = asset($row->image);
                        return '<img src="' . $url . '" alt="Article Image" style="max-width: 50px; height: 50px; border-radius: 4px; object-fit: cover;">';
                    }
                    return '<span class="text-muted">No image</span>';
                })
                ->addColumn('action', function ($data) {
                    $viewRoute = route('admin.article.edit', ['article' => $data->id]);
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

        return view('backend.layout.article.index');
    }


    public function create()
    {
        $categories = Category::all();
        return view('backend.layout.article.create', compact('categories'));
    }


    public function store(ArticleRequest $request)
    {
        try {
            $article = new Article();
            $article->category_id = $request->category_id;
            $article->title = $request->title;
            $article->slug = Str::slug($request->validated('title'));
            $article->description = $request->description;
            $article->year = $request->year;
            $article->order = $request->order;
            $article->status = 'active';

            $oldImage = $article->image;
            $shouldDeleteOldImage = false;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $shouldDeleteOldImage = true;

                $file = $request->file('image');
                $nameForFile = $request->title
                    ? Str::slug($request->title) . '-image-' . time()
                    : 'top-image-' . time();

                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile);
                $article->image = $uploadedPath;
            }

            if ($shouldDeleteOldImage && $oldImage && file_exists(public_path($oldImage))) {
                @unlink(public_path($oldImage));
            }

            $article->status = 'active';


            $article->save();
            return redirect()->route('admin.article.index')->with('t-success', 'Article created successfully');
        } catch (Exception $exception) {
            return redirect()->route('admin.article.index')->with('t-error', $exception->getMessage());
        }
    }


    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('backend.layout.article.edit', compact('article', 'categories'));
    }


    public function update(ArticleRequest $request, Article $article)
    {
        try {
            $article->category_id = $request->category_id;
            $article->title = $request->validated('title');
            $article->slug = Str::slug($request->validated('title'));
            $article->description = $request->description;

            $oldImage = $article->image;

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $nameForFile = $request->title
                    ? Str::slug($request->title) . '-image-' . time()
                    : 'top-image-' . time();

                $uploadedPath = Helper::fileUpload($file, 'images', $nameForFile);
                $article->image = $uploadedPath;

                // Delete old image if exists
                if ($oldImage && file_exists(public_path($oldImage))) {
                    @unlink(public_path($oldImage));
                }
            }

            $article->year = $request->year;
            $article->order = $request->order;
            $article->save();

            return redirect()->route('admin.article.index')
                ->with('t-success', 'Article updated successfully');
        } catch (Exception $exception) {
            return redirect()->route('admin.article.index')
                ->with('t-error', $exception->getMessage() ?: 'Something went wrong');
        }
    }


    public function status(int $id): JsonResponse
    {
        $data = Article::findOrFail($id);
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


    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return response()->json([
                'success' => true,
                'message' => 'Article deleted successfully',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }


    public function bulkDelete(Request $request)
    {
        if ($request->ajax()) {
            $result = Article::whereIn('id', $request->ids)->get();

            if ($result) {
                Article::destroy($request->ids);
                return response()->json([
                    'success' => true,
                    'message' => 'Articles deleted successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Articles not found',
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
