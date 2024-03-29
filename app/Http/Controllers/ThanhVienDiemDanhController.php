<?php

namespace App\Http\Controllers;

use App\Models\ThanhvienDiemdanh;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class ThanhVienDiemDanhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'madiemdanh' => 'required',
                'mathanhvien' => 'required',
            ],
            [
                'madiemdanh.required' => 'Mã điểm danh không được để trống',
                'mathanhvien.required' => 'Mã thành viên không được để trống',
            ]
        );
        $thanhvien = ThanhvienDiemdanh::where('mathanhvien', '=', $request->mathanhvien)->where('madiemdanh', '=', $request->madiemdanh)->whereRaw('cast(created_at AS date) =?', date("Y-m-d"))->get();
        if ($thanhvien->isEmpty()) {
            $thanhvien = [
                'madiemdanh' => $request->madiemdanh,
                'mathanhvien' => $request->mathanhvien,
            ];
            return ThanhvienDiemdanh::create($thanhvien);
        }
        response()->json('Đã điểm danh', Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ThanhvienDiemdanh  $thanhvienDiemdanh
     * @return \Illuminate\Http\Response
     */
    public function show(ThanhvienDiemdanh $thanhvienDiemdanh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ThanhvienDiemdanh  $thanhvienDiemdanh
     * @return \Illuminate\Http\Response
     */
    public function edit(ThanhvienDiemdanh $thanhvienDiemdanh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ThanhvienDiemdanh  $thanhvienDiemdanh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThanhvienDiemdanh $thanhvienDiemdanh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ThanhvienDiemdanh  $thanhvienDiemdanh
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThanhvienDiemdanh $thanhvienDiemdanh)
    {
        //
    }
}