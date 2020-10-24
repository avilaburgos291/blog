@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Semester</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ url('semesters/'.$semester->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="code">{{ __('Code') }}</label>
                            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            value="{{ old('code', $semester->code) }}"
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
                            value="{{ old('title', $semester->title) }}"
                            required autocomplete="title" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ old('description', $semester->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="course_id">{{ __('Course') }}</label>
                            <select id="course_id" class="form-control @error('course_id') is-invalid @enderror" name="course_id" required>
                                <option value="">Seleccione...</option>
                                @if (!$courses->isEmpty())
                                    @foreach($courses as $course) 
                                        <option value="{{$course->id}}" 
                                            @if( (int) $course->id === (int) $semester->course_id) selected='selected' 
                                            @endif
                                        > {{$course->title}} </option> 
                                    @endforeach
                                @endif
                            </select>
                            @error('course_id')
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
