@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $semester->title }} - ${{ $semester->price }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ $semester->description }}

                    @can('update', $semester)
                    <hr>
                    <a href="{{ url('/semesters/'.$semester->id.'/edit') }}" class="btn btn-primary">
                        {{ __('Edit semester') }}
                        </a>
                    @endcan

                </div>
                <div class="card-footer">
                    {{ __('Author') }}:
                    <a href="{{ url('@'.$semester->user->username) }}"> {{ $semester->user->name }} </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
