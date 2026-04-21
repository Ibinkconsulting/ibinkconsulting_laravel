<?php
namespace App\Http\Controllers\Web\backend\admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FAQ::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function ($data) {
                    // Strip HTML tags and truncate the content
                    $content = strip_tags($data->description);
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
                ->addColumn('action', function ($data) {
                    $editRoute = route('faq.edit', ['faq' => $data->id]);
                    return '<div>
                         <a class="btn btn-sm btn-primary" href="' . $editRoute . '">
                             <i class="fa-solid fa-pencil"></i>
                         </a>
                         <button type="button" onclick="deleteRecord(event,' . $data->id . ')" class="btn btn-sm btn-danger">
                             <i class="fa-regular fa-trash-can"></i>
                         </button>
                     </div>';
                })

                ->rawColumns(['description', 'status', 'action'])
                ->make(true);
        }

        return view('backend.layout.faq.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.layout.faq.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            $data              = new FAQ();
            $data->title       = $request->title;
            $data->description = $request->description;
            $data->status      = 'active';
            $data->save();

            flash()->success('FAQ created successfully');
            return redirect()->route('faq.index');

        } catch (Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = FAQ::findOrFail($id);
        return view('backend.layout.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {

            $data              = FAQ::findOrFail($id);
            $data->title       = $request->title;
            $data->description = $request->description;
            $data->status      = 'active';
            $data->save();

            flash()->success('FAQ updated successfully');
            return redirect()->route('faq.index');

        } catch (Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $page = FAQ::findOrFail($id);
            $page->delete();
            flash()->success('FAQ deleted successfully');
            return response()->json([

                'success' => true,
                "message" => "FAQ deleted successfully.",

            ]);
        } catch (\Exception $e) {
            return response()->json([

                'error'   => true,
                "message" => "Failed to delete FAQ.",

            ]);
        }
    }

    public function changeStatus($id)
    {

        $page = FAQ::find($id);

        if (empty($page)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found.",
            ], 404);
        }

        if ($page->status == "active") {
            $page->status = "inactive";
        } else {
            $page->status = "active";
        }
        $page->save();
        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.',
        ]);

    }

}
