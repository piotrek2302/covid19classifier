@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ $xrayImage->name }}</h3></div>

                <div class="card-body">
                    <img class="my-2" src="/storage/{{ $xrayImage->file }}" width="100%"><br>
                    <div><b>Time uploaded: </b>{{ $xrayImage->created_at }}</div>
                    <div class="my-2">
                        <b>Note: </b>
                        {{ $xrayImage->note }} <br>
                    </div>
                    <div class="my-2">
                        <b>File Type: </b>
                        {{ $xrayImage->file_type }} <br>
                    </div>
                    <div class="my-2">
                        <b>Verdict: </b>
                        {{ $xrayImage->result }} <br>
                    </div>
                    <div class="my-2">
                        <b>Comment: </b>
                        {{ $xrayImage->result }} <br>
                    </div>
                    <div class="my-2">
                        <b>Full log: </b>
                        {{ $xrayImage->log }} <br>
                    </div>


                    <a href="/storage/{{ $xrayImage->file }} ">
                        <button type="button" class="btn btn-primary">Download ({{ \App\Models\XrayImage::size($xrayImage->file_size)}})</button>
                    </a>

                </div>
                <div class="card-footer">

                     submitted by: {{$xrayImage->user->email}}
                    <a href="#" > {{ $xrayImage->created_at->diffForHumans() }}</a>

                    <button  data-bs-toggle="modal" data-bs-target="#confirm_delete" type="button" class="btn btn-sm btn-danger rounded float-end"><i class="fa fa-trash"></i> Delete</button>
                    <!-- Modal -->
                    <div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this image?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    please confirm you action.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                    <form method="post" action="{{route('xray.destroy',$xrayImage)}}"/>
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
