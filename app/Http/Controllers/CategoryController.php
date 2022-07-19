<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Log;
use Prophecy\Call\Call;

use function PHPUnit\Framework\callback;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $param = [
            'categories' => $categories,
        ];
        return view('Backend.categories.index',$param);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {


        Category::insert([
            'nameVi' => $request->nameVi,
            'nameEn' => $request->nameEn,
            'created_by' => Auth::user()->id,
            'updated_by' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Thêm danh mục' . $request->name . 'thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('category.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('Backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        Category::findOrFail($id)->update([
            'nameVi' => $request->nameVi,
            'nameEn' => $request->nameEn,
            'created_by' => Auth::user()->id,
            'updated_by' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Cập nhật danh mục' . $request->name . 'thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request['id'];
        Category::where('id', $id)->delete();
        return response()->json(['category' => 'delete success']);
    }
    public function trashed()
    {
        $categories = Category::withTrashed()->get();
        return view('Backend.categories.softDelete', compact('categories'));
    }
    public function restore($id)
    {
        $categories = Category::withTrashed()->find($id);
        try {
            $categories->restore();
            return redirect()->route('categories.trashed')->with('message', 'restore' . ' ' . $categories->name . ' ' .  'success');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.trashed')->with('message', 'restore' . ' ' . $categories->name . ' ' .  'error');
        }
        return view('Backend.categories.softdelete', compact('categories'));
    }
    public function forceDelete($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        try {
            $categories->forceDelete();
            return redirect()->route('categories.trashed')->with('message', 'delete' . ' ' . $categories->name . ' ' .  'success');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.trashed')->with('message', 'delete ' . ' ' . $categories->name . ' ' .  'error');
        }
        return view('Backend.categories.softdelete', compact('categories'));
    }
    // public function getCategorys($id){
    //     if($id!=0){
    //         $categories = Category::find($id)->categories()->select('id', 'name')->get()->toArray();
    //     }else{
    //         $categories = Category::all()->toArray();
    //     }
    //     return response()->json($categories);
    // }
}
