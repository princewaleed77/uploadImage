@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="images ">

                    <img src='{{ asset("uploads/$user->avatar") }}' id="rr" alt="{{$user->name}}" width="50%"
                        class="image-previewer img-fluid">
                    {{-- {{$user->avatar}} --}}
                    <form action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" id="avatar">
                        {{-- <input type="submit" value="submit"> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('ijaboCropTool/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script>
        $('#avatar').ijaboCropTool({
            preview: ".image-previewer",
            setRatio: 1,
            //   allowedExtensions: ['jpg', 'jpeg','png'],
              buttonsText:['CROP & Save','Cancel'],
            //   buttonsColor:['#30bf7d','#ee5155', -15],
            processUrl: '{{ route('crop') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                alert(message);
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });
    </script>
@endsection
