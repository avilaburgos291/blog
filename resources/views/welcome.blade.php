@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">{{ __('Universities') }}</h1>
            @foreach($universities as $universities)
                <div class="card mb-4">
                    <div class="card-header">{{ $universities->id }}. {{ $universities->title }}</div>
                    <div class="card-body">
                        <p>{{ $universities->desription }}</p>
                    </div>
                    <div class="card-footer">
                        {{ __('Author') }}:
                        <a href="{{ url('@'.$universities->user->username) }}"> {{ $universities->user->name }} </a>
                    </div>
                </div>
            @endforeach
            {{ $universities->links() }}
        </div>
    </div>
</div>
@endsection
