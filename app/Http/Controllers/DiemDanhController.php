<?php

namespace App\Http\Controllers;

use App\Models\Diemdanh;
use Illuminate\Http\Request;

class DiemDanhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Diemdanh::all();
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
                'tendiemdanh' => 'required|max:50',
            ],
            [
                'tendiemdanh.required' => 'Tên loại điểm danh không được để trống',
            ]
        );
        return Diemdanh::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diemdanh  $diemdanh
     * @return \Illuminate\Http\Response
     */
    public function show(Diemdanh $diemdanh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diemdanh  $diemdanh
     * @return \Illuminate\Http\Response
     */
    public function edit(Diemdanh $diemdanh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diemdanh  $diemdanh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diemdanh $diemdanh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diemdanh  $diemdanh
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diemdanh $diemdanh)
    {
        //
    }
}
