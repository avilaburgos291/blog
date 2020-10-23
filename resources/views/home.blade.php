@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($universities->isEmpty())
                        <p>{{ __("You didn't publish any university yet." ) }}</p>
                    @else
                        <p>{{ __('Universities') }}</p>
                        <ul>
                            @foreach($universities as $entry)
                                <li>
                                    <a href="{{ $entry->getUrl() }}">{{ $entry->title }}</a>
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
