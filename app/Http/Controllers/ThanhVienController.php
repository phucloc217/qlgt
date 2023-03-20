<?php

namespace App\Http\Controllers;

use App\Models\Thanhvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ThanhVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Thanhvien::join('giaoho', 'thanhvien.giaoho', '=', 'giaoho.id')->select('thanhvien.*', 'giaoho.tengiaoho')->get();
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
                'hoten' => 'required|max:50',
                'ngaysinh' => 'required|date|before:1/1/' . (date('Y') - 17),
                'sdt' => 'regex:/(0)[0-9]{9}/'
            ],
            [
                'hoten.required' => 'Họ tên không được để trống',
                'ngaysinh.required' => 'Ngày sinh không được để trống',
                'ngaysinh.before' => 'Tuổi phải từ 18 trở lên',
                'sdt.regex' => 'Số điện thoại không hợp lệ'
            ]
        );
        $ma = substr(date("Y"), -2) . date("m") . $request->giaoho;
        $tmp = Thanhvien::where('ma', 'LIKE', "%$ma%")->orderBy('ma', 'desc')->select('ma')->first();
        if ($tmp == null)
            $ma = $ma . '01';
        else {
            $ma = (int) $tmp['ma'];
            $ma++;
        }
        $thanhvien = [
            'ma' => $ma,
            'tenthanh' => $request->tenthanh,
            'hoten' => $request->hoten,
            'ngaysinh' => date("Y-m-d", strtotime($request->ngaysinh)),
            'hotencha' => $request->tencha,
            'hotenme' => $request->tenme,
            'diachi' => $request->diachi,
            'ghichu' => $request->ghichu,
            'giaoho' => $request->giaoho,
            'sdt' => $request->sdt,
            'giaoly' => $request->giaoly,
            'matkhau' => $request->sdt != '' ? Hash::make($request->sdt) : Hash::make('123'),
            'trangthai' => 1,
        ];
        if (Thanhvien::create($thanhvien)) {
            return response()->json($ma, Response::HTTP_CREATED);
        } else {
            return response()->json('', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Thanhvien::join('giaoho', 'thanhvien.giaoho', '=', 'giaoho.id')->where('thanhvien.ma', '=', $id)->select('thanhvien.*', 'giaoho.tengiaoho')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thanhvien $thanhvien)
    {
        $thanhvien->update($request->all());
        if ($thanhvien->save())
            return response()->json('success', Response::HTTP_OK);
        return response()->json('error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function updatePassword(Request $request, $id)
    {
        $thanhvien = Thanhvien::find($id);
        if ($thanhvien) {
            $thanhvien->matkhau = Hash::make($request->matkhau);
            if ($thanhvien->save())
                return response()->json('success', Response::HTTP_OK);
        } else
            return response()->json('error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thanhvien = Thanhvien::find($id);
        return $thanhvien->delete();
    }
}