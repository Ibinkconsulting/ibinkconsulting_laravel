<?php

namespace App\Http\Controllers\Web\backend\settings;

use App\Helper\Helper;
use App\Models\DynamicPage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DynamicPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DynamicPage::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('page_content', function ($data) {
                    // Strip HTML tags and truncate the content
                    $content = strip_tags($data->page_content);
                    return $content;
                })
                ->addColumn('status', function ($data) {
                    $status = '<div class="form-check form-switch">';
                    $status .= '<input onclick="changeStatus(event,' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem;"' . $data->id . '" name="status"';
                    if ($data->status == "active") {
                        $status .= ' checked';
                    }
                    $status .= '>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('bulk_check', function ($data) {
                    return Helper::tableCheckbox($data->id);
                })
                ->addColumn('action', function ($data) {
                    $viewRoute = route('dynamicpages.edit',['dynamicpage'=>$data->id]);
                    return '<div>
                         <a class="btn btn-sm btn-primary" href="' . $viewRoute . '">
                             <i class="fa-solid fa-pen"></i>
                         </a>
                         <button type="button" onclick="showDeleteAlert(' . $data->id . ')" class="btn btn-sm btn-danger">
                             <i class="fa-regular fa-trash-can"></i>
                         </button>
                     </div>';
                })

                ->rawColumns(['status','bulk_check', 'action'])
                ->make(true);
        }

        return view('backend.layout.setting.dynamic_page.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.layout.setting.dynamic_page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'page_title' => 'required|max:255|string',
            'page_content' => 'required',

        ]);

        $page = new DynamicPage();
        $page->page_title = $request->page_title;
        $page->page_content = $request->page_content;
        $page->page_slug = Str::slug($request->page_title);
        $page->status = 'active';
        $page->save();

        flash()->success('page created successfully');
        return redirect()->route('dynamicpages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DynamicPage::findOrFail($id);
        return view('backend.layout.setting.dynamic_page.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([

            'page_title' => 'required|max:255|string',
            'page_content' => 'required',

        ]);

        $page = DynamicPage::findOrFail($id);
        $page->page_title = $request->page_title;
        $page->page_content = $request->page_content;
        $page->page_slug = Str::slug($request->page_title);
        $page->status = 'active';
        $page->save();

        flash()->success('page updated successfully');
        return redirect()->route('dynamicPages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $page = DynamicPage::findOrFail($id);
            $page->delete();
            flash()->success('page deleted successfully');
            return response()->json([

                'success' => true,
                "message" => "Page deleted successfully."

            ]);
        } catch (\Exception $e) {
            return response()->json([

                'error' => true,
                "message" => "Failed to delete page."

            ]);
        }
    }

    public function changeStatus($id)
    {
        $data = DynamicPage::find($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        
        // Toggle status
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
        $page->save();
        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.'
        ]);
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
            $result = DynamicPage::whereIn('id', $request->ids)->get();

            if ($result) {
                DynamicPage::destroy($request->ids);
                return response()->json([
                    'success' => true,
                    'message' => 'Pages deleted successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Pages not found',
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
