<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use cnviradiya\LaravelFilepond\Filepond;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $productSD;
    function __construct()
    {
        $this->middleware('role_or_permission:Product access|Product create|Product edit|Product delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Product viewAny', ['only' => ['index']]);
        $this->middleware('role_or_permission:Product view', ['only' => ['show']]);
        $this->middleware('role_or_permission:Product create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Product update', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Product delete', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:Category forceDelete', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:Category restore', ['only' => ['restore']]);
    }
    public function index(SearchRequest $request)
    {
        $term = $request->keyword;

        // dd($term);
        $products = Product::where('created_at', '>', now()->subMonths(3))
            ->search($term)
            ->nameCate($request)
            ->filter(request(['startPrice','endPrice']))
            ->form_date_to(request(['start_date','end_date']))
            ->status($request)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $categories = Category::all();
        $suppliers = Supplier::all();
        $productSD = Product::onlyTrashed()->get();
        $param = [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'products' => $products,
            'productSD' => $productSD,
        ];

        return view('Backend.Products.index', $param);
    }
    // public function searchAdvanced(Request $request)
    // {
    //     $term = $request->keyword;

    //     $products = Product::where('created_at', '>', now()->subMonths(3))
    //         ->search($term)
    //         ->nameCate($request)
    //         ->filter(request(['startPrice','endPrice']))
    //         ->form_date_to(request(['start_date','end_date']))
    //         ->orderBy('id', 'DESC')
    //         ->paginate(6);

    //     return view('Backend.Products.index', compact('products'));
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $param = [
            'categories' => $categories,
            'suppliers' => $suppliers,
        ];
        return view('Backend.Products.add', $param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        if (!$request->category_id == null) {
            $count_category = count($request->category_id);
            for ($i = 0; $i < $count_category; $i++) {
                $product = new Product;
                $product->category_id = $request->category_id[$i];

                $product->nameVi = $request->nameVi[$i];
                $product->nameEn = $request->nameEn[$i];
                $product->price = $request->price[$i];
                $product->description = $request->description[$i];
                $product->quantity = $request->quantity[$i];
                $product->total = $request->total[$i];

                $product->status = '0';
                $product->created_by = Auth::user()->id;
                $product->updated_by = Carbon::now();
                $product->save();
            }
        }

        $notification = array(
            'message' => 'Thêm sản phẩm thành công',
            'alert-type' => 'success',
        );
        try {
            $product->save();
            return redirect()->route('product.index')->with($notification);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $notification = [
                'message' => 'Thêm sản phẩm cấp thất bại !!!',
                'alert-type' => 'warning',
            ];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('Backend.Products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('Backend.Products.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = new Product;
        $product->nameVi = $request->nameVi;
        $product->nameEn = $request->nameEn;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->created_by = Auth::user()->id;
        $product->updated_by = Carbon::now();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extention;
            $file->move('/images/products/', $fileName);
            $product->image = $fileName;
        }
        try {
            $product->save();
            $notification = array(
                'message' => 'Cập nhật sản phẩm' . $request->name . 'thành công',
                'alert-type' => 'success',
            );
            return redirect()->route('product.index')->with($notification);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $notification = array(
                'message' => 'Cập nhật sản phẩm cấp thất bại !!!',
                'alert-type' => 'warning',
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productdl = Product::findOrFail($id);
        $productdl->destroy($id);

        return response()->json(['product' => 'delete successFully']);
        // try {
        // } catch (\Exception $e) {
        //     Log::error($e->getMessage());

        //     return response()->json(['product' => 'delete faill']);
        // }
        // if(Storage::delete('public/image/'. $productdl->photo)){

        // };
    }

    public function trashed()
    {
        $this->productSD;
    }

    public function restore($id)
    {
        $this->productSD = Product::withTrashed()->findOrFail($id);
        $this->productSD->restore();

        return redirect()->back()->with('message', 'restore successFully');
    }

    public function forceDelete($id)
    {
        $this->productSD = Product::onlyTrashed()->findOrFail($id);
        $this->productSD->forceDelete();

        return redirect()->back()->with('message', 'delete successFully');
    }

    public function DeleteForever($id)
    {
        Product::onlyTrashed()->where('deleted_at', '<', Carbon::now()->subMinutes(1)->toDateTimeString())->forceDelete();
    }
    public function getCategory(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $allcategory = Category::where('supplier_id', $supplier_id)->get();
        return response()->json($allcategory);
    }
    public function showToFe($id)
    {
        $product = Product::findOrFail($id);
        $product->status = '1';
        if ($product->save()) {
            $notification = array(
                'message' => 'Duyệt sản phẩm thành công',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
    public function hideToFe($id)
    {
        $product = Product::findOrFail($id);
        $product->status = '0';
        if ($product->save()) {
            $notification = array(
                'message' => 'Ẩn sản phẩm thành công',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
