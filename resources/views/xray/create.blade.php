@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        Upload new X-ray image
                    </div>
                    <div class="card-body">
                        <form id="create_form" method="POST" action="{{ route('xray.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mt-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name *') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>

                                <div class="col-md-6">
                                    <textarea id="note" type="text" class="form-control @error('note') is-invalid @enderror" rows="4" name="note" autocomplete="note" autofocus>{{ old('note') }}</textarea>

                                    @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File *') }}</label>

                                <div class="col-md-6">
                                    <input accept=".png,.jpg,.jpeg" id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" required autocomplete="file">

                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <span id="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span id="command_text"> {{ __('Upload') }}</span>
                                    </button>

                                </div>
                            </div>
                        </form>


                    </div>
                </div>
        </div>
    </div>
</div>
    <script>
        var spinner = document.getElementById('loading');
        var command_text = document.getElementById('command_text');
        var theform = document.getElementById('create_form');
        spinner.style.display='none'

        theform.addEventListener('submit',function(ev){
            ev.preventDefault();
            spinner.style.display='inline-block';
            command_text.innerText='Analysing Image';
            ev.target.submit();
        })


    </script>
@endsection

