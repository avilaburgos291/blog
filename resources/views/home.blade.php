@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Universities') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($universities->isEmpty())
                        <p>{{ __("You didn't create any university yet." ) }}</p>
                    @else
                        <div id="accordion">
                            @foreach($universities as $university)
                            <div class="card">                                
                                <div class="card-header" id="heading{{ $university->id }}">
                                    <h5 class="mb-0 d-flex justify-content-between ">
                                        <button class="btn btn-link" 
                                            data-toggle="collapse" 
                                            data-target="#collapse{{ $university->id }}" aria-expanded="true" aria-controls="collapse{{ $university->id }}">
                                            {{ $university->title }}
                                        </button>
                                        <a class="btn btn-info" href="{{ $university->getUrl() }}">See data</a>
                                    </h5>
                                </div>                        
                                <div id="collapse{{ $university->id }}" 
                                    class="collapse show" 
                                    aria-labelledby="heading{{ $university->id }}" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>{{ $university->description }}</p>
                                        @if ($courses->isEmpty())
                                            <p>{{ __("You didn't create any courses yet." ) }}</p>
                                        @else                                            
                                            <ul class="list-group">  
                                                <li class="list-group-item d-flex justify-content-between align-items-center ">
                                                    <h5>{{ __('Courses') }}</h5>
                                                </li>                              
                                                @foreach($courses as $course)
                                                    @if ($course->university_id == $university->id)
                                                        @if (!$courses_totales->isEmpty())
                                                            @foreach($courses_totales as $course_total)
                                                                @if ($course_total->course_id == $course->id)
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center ">
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
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <ul class="list-group">
                            @foreach($universities as $university)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                   
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
