@extends('dashboard')

@section('content')
<div class="bg-light p-4 rounded">
        <h1>Add new blog</h1>
        <div class="container mt-4">
            <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="test" class="form-label">Description</label>
                    <input value="{{ old('description') }}"
                        type="text" 
                        class="form-control" 
                        name="description" 
                        placeholder="description" required>
                        @if ($errors->has('description'))
                            <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                        @endif
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                   
                    <br />
                        @foreach($categorys as $category)
                            <input type="checkbox" name="category_id[]" value="{{ $category['name'] }}"/> {{$category['name']}}
                        @endforeach
                    
                    @if ($errors->has('category_id'))
                        <span class="text-danger text-left">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save user</button>
                <a href="{{ route('blogs') }}" class="btn btn-default" style="border: 1px solid;">Back</a>
            </form>
        </div>

    </div>
@endsection