<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Supplier access|Supplier create|Supplier edit|Supplier delete', ['only' => ['index']]);
        $this->middleware('role_or_permission:Supplier viewAny', ['only' => ['index']]);
        $this->middleware('role_or_permission:Supplier create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Supplier update', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Supplier delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'desc')->get();

        return view('Backend.Supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Supplier.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        try {
            Supplier::insert([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);
            $notification = [
                'message' => 'Thêm nhà cung cấp thành công',
                'alert-type' => 'success',
            ];

            return redirect()->route('supplier.index')->with($notification);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $notification = [
                'message' => 'Thêm nhà cung cấp thất bại !!!',
                'alert-type' => 'warning',
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('Backend.Supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->email  = $request->email;
        $supplier->address = $request->address;
        $supplier->save();
        $notification = [
            'message' => 'Cập nhật nhà cung cấp thành công',
            'alert-type' => 'success',
        ];

        return redirect()->route('supplier.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        Supplier::where('id', $id)->delete();

        return response()->json(['supplier' => 'delete success']);
    }
}
