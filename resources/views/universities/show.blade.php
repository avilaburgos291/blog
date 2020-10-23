@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $university->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ $university->description }}

                    @if( $university->user_id === auth()->id())
                    <hr>
                    <a href="{{ url('/universities/'.$university->id.'/edit') }}" class="btn btn-primary">
                        {{ __('Edit University') }}
                        </a>
                    @endif

                    @can('update', $university)
                    <hr>
                    <a href="{{ url('/universities/'.$university->id.'/edit') }}" class="btn btn-primary">
                        {{ __('Edit University') }}
                        </a>
                    @endcan

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
