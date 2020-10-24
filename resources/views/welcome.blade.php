@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="mb-4">{{ __('Universities') }}</h1>
            @foreach($universities as $university)
                <div class="card mb-4">
                    <div class="card-header">{{ $university->id }}. {{ $university->title }}</div>
                    <div class="card-body">
                        <p>{{ $university->description }}</p>
                        @if ($courses->isEmpty())
                            <p>{{ __("You didn't create any courses yet." ) }}</p>
                        @else
                            <p>{{ __('Courses') }}</p>
                            <ul class="list-group">                                
                                @foreach($courses as $course)
                                    @if ($course->university_id == $university->id)
                                        @if (!$courses_totales->isEmpty())
                                            @foreach($courses_totales as $course_total)
                                                @if ($course_total->course_id == $course->id)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <h5>
                                                            <a href="{{ $course->getUrl() }}">{{ $course->code }} - {{ $course->title }} 
                                                            </a>
                                                        </h5>
                                                        <h5><span class="badge badge-info">
                                                            <b>Investment: ${{ number_format($course_total->price_total_cuorse, 2, ',', '.') }}
                                                            </b>
                                                            </span>
                                                            <span class="badge badge-info">
                                                                Average cost per semester: ${{ number_format($course_total->price_avg_cuorse, 2, ',', '.') }} 
                                                            </span>
                                                        </h5>
                                                    </li>
                                                    <ul class="list-group">
                                                    @if (!$semesters->isEmpty())
                                                        @foreach($semesters as $semester)
                                                            @if ($semester->course_id == $course->id)
                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                    <a href="{{ $semester->getUrl() }}">{{ $semester->code }} - {{ $semester->title }} 
                                                                        Price: ${{ number_format($semester->price, 2, ',', '.') }}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    </ul>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="card-footer">
                        {{ __('Create by') }}:
                        <a href="{{ url('@'.$university->user->username) }}"> {{ $university->user->name }} </a>
                    </div>
                </div>
            @endforeach
            {{ $universities->links() }}
        </div>
    </div>
</div>
@endsection
