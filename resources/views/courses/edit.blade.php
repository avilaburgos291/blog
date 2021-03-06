@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Course</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ url('courses/'.$course->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="code">{{ __('Code') }}</label>
                            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            value="{{ old('code', $course->code) }}"
                            required autocomplete="code" autofocus>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ old('title', $course->title) }}"
                            required autocomplete="title" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="university">{{ __('University') }}</label>
                            <select id="university" class="form-control @error('university') is-invalid @enderror" name="university" required>
                                <option value="">Seleccione...</option>
                                @if (!$universities->isEmpty())
                                    @foreach($universities as $university) 
                                        <option value="{{$university->id}}" 
                                            @if( (int) $university->id === (int) $course->university_id) selected='selected' 
                                            @endif
                                        > {{$university->title}} </option> 
                                    @endforeach
                                @endif
                            </select>
                            @error('university')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>       
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save changes') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
