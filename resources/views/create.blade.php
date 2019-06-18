@extends('layouts.app')

@section('title', 'Create Product')

@section('content')

    <div class="row">
        <form class="col-md-6 offset-md-3" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            <h2>Create desired product</h2>
            <hr>
            @csrf

            <div class="form-group">
                <label class="font-weight-bold" for="name">Name:</label>
                <input id="name"
                       type="text"
                       name="name"
                       class="form-control @error('name') border-danger @enderror"
                       value="{{old('name')}}"
                >
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="category">Category:</label>
                <select @if($categories->count() == 0) disabled @endif id="category" class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{old('category_id') ? "selected" : ""}}>{{$category->name}}</option>
                    @endforeach
                </select>

                <div class="mt-1 pl-3 bg-light p-1">
                    <input type="checkbox" onclick="approveNewCreation();" name="new_category_checkbox" id="new_category_checkbox">
                    <label for="new_category">Create new: </label>
                    <input disabled type="text" name="new_category" id="new_category" class="inline">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-6">
                    <div class=" d-inline">
                        <label class="font-weight-bold" for="price">Price:</label>
                        <input id="price"
                               type="text"
                               name="price"
                               class="form-control @error('price') border-danger @enderror"
                               value="{{old('price')}}"
                        >
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" d-inline">
                        <label class="font-weight-bold" for="rating">Rating:</label>
                        <input id="rating"
                               type="text"
                               name="rating"
                               class="form-control @error('rating') border-danger @enderror"
                               value="{{old('rating')}}"
                        >
                        @error('rating')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="img">Image:</label>
                <input type="file" name="img" id="img" class="form-control-file">
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="description">Description:</label>
                <textarea id="description"
                          name="description"
                          rows="5"
                          class="form-control @error('description') border-danger @enderror"
                >{{old('description')}}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <input class="btn btn-sm btn-primary form-control" type="submit" value="Create">

        </form>
    </div>

@endsection

<script>
    let approved = false;

    function approveNewCreation() {
        document.getElementById('new_category').disabled = approved;

        if(approved)
            document.getElementById('new_category').value = "";

        approved = !approved;
    }
</script>