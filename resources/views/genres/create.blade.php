@extends('layouts.backend', compact('title'))
@section('content')
  <div class="card">
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
      <form action="{{ route('genres.create') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="name" class="form-label">Name</label>
          <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
          @error('name')
              <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </div>
@endsection