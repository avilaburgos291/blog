@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Semesters') }}
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
                        <p>{{ __('Semesters') }}</p>
                        <ul>
                            @foreach($semesters as $semester)
                                <li>
                                    <a href="{{ $semester->getUrl() }}">{{ $semester->course->code }} - {{ $semester->course->title }} 
                                        <b> {{ $semester->code }} - {{ $semester->title }} ${{ $semester->price }}</b>
                                    </a>
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
