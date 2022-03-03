@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your X-ray images') }}</div>


                    @if (session('status'))
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    </div>
                    @endif
            </div>

            @foreach($images as $image)
                <div class="card my-2" >
                    <div class="card-header">{{ $image->name }}</div>
                    <div class="card-body">
                        {{$image->note}}<br>
                        {{$image->file_type}}
                        <br>
                        <a href="{{route('xray.show',$image->id)}}">view more</a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
