@extends('layouts.app')

@section('title', 'Products')

@section('content')

    <h1 class="d-block text-center font-weight-bold mb-4">NGSoft Product Store</h1>

    <div>
        <form id="searchForm" class="d-inline-block" action="{{ route('products') }}">
            <div class="input-group">
                <input type="text" name="searchTerm" value="{{ request('searchTerm') }}" class="form-control input-lg" placeholder="Search by name...">
                <span class="input-group-btn">
                    <button class="btn btn-lg btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>

            <div class="form-group mt-2">
                <label class="mb-0 font-weight-bold mr-2">Rating: </label>
                @for($i = 1; $i <= 5; $i++)
                    <div class="form-check form-check-inline">
                        <input type="checkbox"
                               name="filterRating[{{$i}}]"
                               id="filterRating" value="{{$i}}"
                               class="form-check-input"
                               @if(request('filterRating')!=null and array_key_exists($i, request('filterRating'))) checked @endif
                               onclick="sendRequest();"  >
                        <label for="filterRating" class="form-check-label">{{$i}}</label>
                    </div>
                @endfor
            </div>
        </form>

        <span class="sortablelink">@sortablelink('name')</span>
        <span class="sortablelink">@sortablelink('price')</span>
        <span class="sortablelink">@sortablelink('rating')</span>
        <span class="sortablelink">@sortablelink('description')</span>
        <span class="sortablelink">
            @if(request('sort') == 'category' and request('direction') == 'asc')
                <a href="{{route('products', ['filterRating' => request('filterRating'),'sort' => 'category', 'direction'=> 'desc'])}}"
                    onclick="">Category</a>
                <i class="fa fa-sort-alpha-up"></i>
            @elseif(request('sort') == 'category')
                <a href="{{route('products', ['filterRating' => request('filterRating'),'sort' => 'category', 'direction'=> 'asc'])}}"
                   onclick="">Category</a>
                <i class="fa fa-sort-alpha-down"></i>
            @else
                <a href="{{route('products', ['filterRating' => request('filterRating'),'sort' => 'category', 'direction'=> 'asc'])}}"
                   onclick="">Category</a>
                <i class="fa fa-sort"></i>
            @endif
        </span>

        <div class="d-inline-block float-right">
            <a href="{{route('products.create')}}" class="btn btn-primary d-block text-light">Create Product</a>
        </div>

    </div>


    <div class="row">

        @foreach($products as $product)
            <div class="col-lg col-md-3 col-sm-6">
            <div class="card">
                <img src="{{$product->image}}" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <small class="text-muted">{{$product->category->name}}</small>
                    <h5 class="card-title mb-1 font-weight-bold" style="height: 50px;" >{{$product->name}}</h5>
                    <p class="mb-1" style="height: 20px;">
                    @for($i = 0; $i <= $product->rating-1; $i++)
                        <span><i class="fas fa-star text-warning"></i></span>
                    @endfor
                    </p>
                    <p class="card-text" style="height: 150px;">
                        @shorten($product->description)
                    </p>
                    <p>Price: {{$product->price}}$</p>
                    <a href=""  class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            </div>

        @endforeach

    </div>
    <nav class="mt-2">
        {{$products->appends(request()->only(['searchTerm', 'filterRating', 'sort', 'direction']))->links()}}
    </nav>

    <script>
        function sendRequest() {
            document.getElementById('searchForm').submit();
        }


    </script>

@endsection