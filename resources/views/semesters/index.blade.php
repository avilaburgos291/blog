@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between ">{{ __('Semesters') }}
                    <a class="btn btn-info" href="{{ route('semesters.create') }}"> New semester </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($semesters->isEmpty())
                        <p>{{ __("You didn't create any semesters yet." ) }}</p>
                    @else
                        <ul class="list-group"> 
                            @foreach($semesters as $semester)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <h5>
                                        <a href="{{ $semester->getUrl() }}">
                                            <b> {{ $semester->code }} - {{ $semester->title }} ${{ $semester->price }}</b>
                                        </a>
                                    </h5>
                                    <h5>
                                        <span class="badge badge-info">
                                            {{ $semester->course->university->title }}
                                             - {{ $semester->course->title }}
                                        </span>
                                    </h5>
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
