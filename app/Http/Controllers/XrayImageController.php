<?php

namespace App\Http\Controllers;

use App\Models\XrayImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $data=$request->all();
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'file' => ['required'],
        ])->validate();

        $data['user_id']=auth()->user()->id;
        $data['file_size']=$request->file->getSize();
        //update file
        $data['file']=$request->file->store('xray-image','public');

        $data['file_type']=$request->file->getMimeType();

        $base_path = base_path();
        $script = base_path("python")."\classifier.py";
        $python = env('PYTHON_LOCATION', 'C:\Python27\python');
        $image_path = storage_path('app\\public\\').$data['file'];

//        dd($python." ".$script." ".$image_path." ".$base_path);
        $result = json_decode(shell_exec($python." ".$script." ".$image_path." ".$base_path));
        $data['log']=$result->raw[0].','.$result->normal;
        $data['result']=$result->verdict;
        $data['comment']=$result->verdict=='Covid-19'?'You are covid-19 positive with '.round($result->raw[0]*100,2):'You are covid-19 negative';
        $image = XrayImage::create($data);
        return redirect(route('xray.show',$image->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\XrayImage  $xrayImage
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $xrayImage = XrayImage::findOrFail($id);
        return view('xray.show',compact('xrayImage'));
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
    public function destroy(int $id)
    {
        $xrayImage=XrayImage::find($id);
        $xrayImage->delete();
        return redirect(route('xray.index'));
    }
}
