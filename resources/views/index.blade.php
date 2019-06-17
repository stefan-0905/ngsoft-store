@extends('layouts.app')

@section('title', 'Products')

@section('content')

    <h2>Hello</h2>

    @foreach($products as $product)

        <p>{{$product->name}}</p>

    @endforeach

    {{$products->links()}}

@endsection