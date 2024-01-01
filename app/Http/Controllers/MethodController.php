<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Method;


class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Method::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $name = $request->name;
            if (Method::where('name', $name)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Phương thức thanh toán này đã tồn tại'
                ], 400);
            }

            $new_method = new Method;
            $new_method->name = $name;
            $new_method->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Thêm mới phương thức thanh toán thành công'
            ], 200); 
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'success',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $method = Method::find($id);
        if (!$method) {
            return response()->json([
                'status' => 'not found',
                'message' => 'phương thức thanh toán không tồn tại',
            ], 404);
        }
        return $method;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $method = Method::find($id);
        if (!$method) {
            return response()->json([
                'status' => 'not found',
                'message' => 'phương thức thanh toán không tồn tại',
            ], 404);
        }

        $method->name = $request->name;
        $method->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật phương thức thanh toán thành công',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $method = Method::find($id);
        if (!$method) {
            return response()->json([
                'status' => 'not found',
                'message' => 'phương thức thanh toán không tồn tại',
            ], 404);
        }

        $method->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa phương thức thanh toán thành công'
        ], 200);
    }
}
