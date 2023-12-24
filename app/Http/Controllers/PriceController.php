<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\Room;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Price::with('room')->paginate(10);
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
            $new_price = new Price;
            $room_id = $request->room_id;

            if (Room::where('id', $room_id)->exists()) {
                $new_price->room_id = $room_id;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không có room này'
                ], 400);
            }

            if (Price::where('room_id', $room_id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Giá phòng này đã có'
                ], 400);
            }

            $new_price->price = $request->price;
            $new_price->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Thêm mới giá phòng thành công'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $price = Price::with('room')->find($id);
        if (!$price) {
            return response()->json([
                'status' => 'not found',
                'message' => 'price room not found',
            ], 404);
        }
        return $price;
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
        $price = Price::with('room')->find($id);
        if (!$price) {
            return response()->json([
                'status' => 'not found',
                'message' => 'price room not found',
            ], 404);
        }
        
        $price->price = $request->price;
        $price->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật giá phòng thành công',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $price = Price::find($id);
        if (!$price) {
            return response()->json([
                'status' => 'not found',
                'message' => 'price room not found',
            ], 404);
        }

        $price->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa giá phòng thành công'
        ], 200);
    }
}
