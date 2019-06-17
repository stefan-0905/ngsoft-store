@extends('layouts.app')

@section('title', 'Products')

@section('content')

    <h2 class="d-block text-center font-weight-bold">NGSoft Product Store</h2>

    <div>
        <form action="{{ route('products') }}">
            <div class="input-group w-25">
                <input type="text" name="searchTerm" value="{{ request('searchTerm') }}" class="form-control input-lg" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-lg btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>

    </div>

    <div class="row">

        @foreach($products as $product)
            <div class="col-lg col-md-3 col-sm-6">
            <div class="card">
                <img src="{{$product->image}}" class="card-img-top" alt="Product Image">
                <div class="card-body">
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
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            </div>

        @endforeach

    </div>
    <div class="mt-2">
        {{$products->links()}}
    </div>


@endsection