@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>{{ __('Published entries') }}</p>
                    <ul>
                        @foreach($universities as $university)
                            <li>
                                <!-- Se modifica para obetenr la ruta desde el modelo :)
                                <a href="{{ url('entries/'.$university->slug.'-'.$university->id) }}">{{ $university->title }}</a>-->
                                <a href="{{ $university->getUrl() }}">{{ $university->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
