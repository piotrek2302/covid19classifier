@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your X-ray images') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            @foreach($images as $image)
                <div class="card">
                    <div class="card-header"><h3>{{ $dataset->filename }}</h3></div>

                    <div class="card-body">
                        {{$dataset->filetype}}

                        <br>
                        <a href="{{route('dataset.show',$dataset->id)}}">Learn more</a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
