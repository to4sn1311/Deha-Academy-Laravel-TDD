<!-- resources/views/tasks/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Create a new task</h1>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span id="name-error" class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content"
                class="form-control @error('content') is-invalid @enderror"></textarea>
            @error('content')
                <span id="content-error" class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Task</button>
    </form>
</div>
@endsection
