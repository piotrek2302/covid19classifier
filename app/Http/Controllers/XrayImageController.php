<?php

namespace App\Http\Controllers;

use App\Models\XrayImage;
use Illuminate\Http\Request;

class XrayImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=auth()->user()->id;

        $images = XrayImage::where('user_id',$id)->get();

        return view('xray.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('xray.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\XrayImage  $xrayImage
     * @return \Illuminate\Http\Response
     */
    public function show(XrayImage $xrayImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\XrayImage  $xrayImage
     * @return \Illuminate\Http\Response
     */
    public function edit(XrayImage $xrayImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\XrayImage  $xrayImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, XrayImage $xrayImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\XrayImage  $xrayImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(XrayImage $xrayImage)
    {
        //
    }
}
