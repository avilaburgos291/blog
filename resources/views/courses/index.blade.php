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
                        <p>{{ __("You didn't create any university yet." ) }}</p>
                    @else
                        <p>{{ __('Courses') }}</p>
                        <ul>
                            
                            @foreach($courses as $course)
                                @if (!$courses_totales->isEmpty())
                                    @foreach($courses_totales as $course_total)
                                        @if ($course_total->course_id == $course->id)
                                            <li>
                                                <a href="{{ $course->getUrl() }}">{{ $course->code }} - {{ $course->title }} 
                                                    Investment: ${{ number_format($course_total->price_total_cuorse, 2, ',', '.') }}
                                                </a>
                                            </li>
                                            <ul>
                                            @if (!$semesters->isEmpty())
                                                @foreach($semesters as $semester)
                                                    @if ($semester->course_id == $course->id)
                                                        <li>
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
                                
                            @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
