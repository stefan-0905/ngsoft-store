@extends('layouts.app')

@section('title', 'Create Product')

@section('content')

    <div class="row">
        <form class="col-md-6 offset-md-3" action="{{ route('products.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label class="font-weight-bold" for="name">Name:</label>
                <input id="name"
                       type="text"
                       name="name"
                       class="form-control {{$errors->first('name') ? "border-danger" : ""}}"
                       value="{{old('name')}}"
                >
                @if($errors->first('name'))
                <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="category">Category:</label>
                <select id="category" class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{old('category_id') ? "selected" : ""}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="row form-group">
                <div class="col-md-6">
                    <div class=" d-inline">
                        <label class="font-weight-bold" for="price">Price:</label>
                        <input id="price"
                               type="text"
                               name="price"
                               class="form-control {{$errors->first('price') ? "border-danger" : ""}}"
                               value="{{old('price')}}"
                        >
                        @if($errors->first('price'))
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" d-inline">
                        <label class="font-weight-bold" for="rating">Rating:</label>
                        <input id="rating"
                               type="text"
                               name="rating"
                               class="form-control {{$errors->first('rating') ? "border-danger" : ""}}"
                               value="{{old('rating')}}"
                        >
                        @if($errors->first('rating'))
                            <span class="text-danger">{{$errors->first('rating')}}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="description">Description:</label>
                <textarea id="description"
                          name="description"
                          rows="5"
                          class="form-control {{$errors->first('description') ? "border-danger" : ""}}"
                >{{old('description')}}</textarea>
                @if($errors->first('description'))
                    <span class="text-danger">{{$errors->first('description')}}</span>
                @endif
            </div>

            <input class="btn btn-sm btn-primary form-control" type="submit" value="Create">

        </form>
    </div>

@endsection