@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $course->title }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ $course->description }}

                    

                    @can('update', $course)
                    <hr>
                    <a href="{{ url('/courses/'.$course->id.'/edit') }}" class="btn btn-primary">
                        {{ __('Edit course') }}
                        </a>
                    @endcan

                </div>
                <div class="card-footer">
                    {{ __('Author') }}:
                    <a href="{{ url('@'.$course->user->username) }}"> {{ $course->user->name }} </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
