@extends('layouts.admin')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>

                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="products">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-heading">
                                <h2>Latest Products</h2>
                                <a href="{{url('user/comm/create')}}">view all products <i class="fa fa-angle-right"></i></a>

                                <form action="{{url('user/search')}}" method="get" class="form-inline" style="float: right; padding: 30px;">
                                    @csrf

                                    <input class="form-control" type="search" name="search" placeholder="search">
                                    <input type="submit" value="search" class="btn btn-success">

                                </form>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <div class="row grid">
                                    @foreach ($product as $products)
                                    <div class="col-lg-3 col-md-12 all des">
                                        <div class="product-item">
                                            <a href="#"><img height="170" width="40" src="/productimage/{{$products->image}}" alt=""></a>
                                            <div class="down-content">
                                                <a href="/productimage/{{$products->image}}"><h4>{{$products->product_name}}</h4></a></b>
                                                <h6>&#8358;{{number_format($products->price)}}</h6>
                                                <p>{{$products->descp}}</p>

                                                <form action="{{route('user.cart.store')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$products->id}}" name="id">
                                                    <input type="number" value="1" min="1" style="width:100px" class="form-control" name="quantity">
                                                    <br>
                                                    <input class="btn btn-primary" type="submit" value="Add to Cart">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    @if (method_exists($product, 'links'))
                                    <div class="d-flex justify-content-center">
                                        {!! $product->links() !!}
                                    </div>
                                    @endif


                                </div>
                            </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
