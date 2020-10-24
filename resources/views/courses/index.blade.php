@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Courses') }}
                    <a class="btn btn-info" href="{{ route('courses.create') }}"> New Course </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($courses->isEmpty())
                        <p>{{ __("You didn't publish any university yet." ) }}</p>
                    @else
                        <p>{{ __('Courses') }}</p>
                        <ul>
                            @foreach($courses as $course)
                                <li>
                                    <a href="{{ $course->getUrl() }}">{{ $course->title }}</a>
                                </li>
                            @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
