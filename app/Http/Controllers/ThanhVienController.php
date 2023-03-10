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
        return Thanhvien::join('giaoho','thanhvien.giaoho','=','giaoho.id')->select('thanhvien.*','giaoho.tengiaoho')->get();
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
        $ma = substr(date("Y"),-2).date("m").$request->giaoho;
        $tmp = Thanhvien::where('ma','LIKE',"%$ma%")->orderBy('ma', 'desc')->select('ma')->first();
        if($tmp==null)
            $ma=$ma.'01';
        else
        {
            $ma =(int)$tmp['ma']; 
            $ma++;
        }
        $thanhvien =[
            'ma' => $ma,
            'tenthanh'=>$request->tenthanh,
            'hoten'=>$request->hoten,
            'ngaysinh'=> $request->ngaysinh,
            'hotencha'=>$request->tencha,
            'hotenme'=>$request->tenme,
            'diachi'=>$request->diachi,
            'ghichu'=>$request->ghichu,
            'giaoho'=>$request->giaoho,
            'sdt'=>$request->sdt,
            'giaoly'=>$request->giaoly,
            'matkhau'=>$request->sdt!=''?Hash::make($request->sdt):Hash::make('123'),
            'trangthai'=>1,
        ];
        if(Thanhvien::create($thanhvien))
        {
            return response()->json($ma, Response::HTTP_CREATED);
        }
        else
        {
            return response()->json('',Response::HTTP_INTERNAL_SERVER_ERROR);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
