<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    public function index()
    {
        $products = Product::latest()->get()
        ->filter(fn($product) => $product->nameVi > now()->subMonths(3))
        ->paginate(6);
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
        // dd($_FILES);
        // if ($request->hasFile('photo')) {
        //     $file = $request->file('photo');
        //     $filenameWithExt = $request->file('photo')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('photo')->getClientOriginalExtension();
        //     $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
        //     $path = $request->file('photo')->storeAs('public/uploads/', $fileNameToStore);
        //     $product['photo'] = $fileNameToStore;
        // }
        // $path = $filepond->getPathFromServerId($request->input('photo')); // Here upload_file is your name of your element
        // $pathArr = explode('.', $path);
        // $imageExt = '';
        // if (is_array($pathArr)) {
        //     $imageExt = end($pathArr);
        // }
        // $fileName = 'photo.' . $imageExt;
        // $finalLocation = storage_path('uploads/' . $fileName);
        // \File::move($path, $finalLocation);
        try {
            $product->save();
            $notification = [
                'message' => 'Thêm sản phẩm' . $request->name . 'thành công',
                'alert-type' => 'success',
            ];

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
        // dd($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extention;
            $file->move('/images/products/', $fileName);
            $product->image = $fileName;
        }
        try {
            $product->save();
            $notification = [
                'message' => 'Cập nhật sản phẩm' . $request->name . 'thành công',
                'alert-type' => 'success',
            ];

            return redirect()->route('product.index')->with($notification);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $notification = [
                'message' => 'Cập nhật sản phẩm cấp thất bại !!!',
                'alert-type' => 'warning',
            ];

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
}
