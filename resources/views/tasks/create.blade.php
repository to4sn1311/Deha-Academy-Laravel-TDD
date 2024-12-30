<!-- resources/views/tasks/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Create a new task</h1>
<form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Task Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Task</button>
</form>
@endsection