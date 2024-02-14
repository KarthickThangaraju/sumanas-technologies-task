@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <div id="products" class="row view-group">
            @foreach($productlists as $products)
        <div class="item col-xs-4 col-lg-4"><br>
            <div class="thumbnail card">
                <div class="img-event">
                @if ($products->id == 1)
                    <img class="group list-group-image img-fluid" src="{{ URL::to('/') }}/images/allen.jpg" alt="" / style="height:350px;width:350px">
                @elseif ($products->id == 2)
                    <img class="group list-group-image img-fluid" src="{{ URL::to('/') }}/images/louis.jpg" alt="" / style="height:350px;width:350px">
                @elseif ($products->id == 3)
                    <img class="group list-group-image img-fluid" src="{{ URL::to('/') }}/images/otto.jpg" alt="" / style="height:350px;width:350px">
                @elseif ($products->id == 4)
                    <img class="group list-group-image img-fluid" src="{{ URL::to('/') }}/images/terrain.jpg" alt="" / style="height:350px;width:350px">
                @elseif ($products->id == 5)
                    <img class="group list-group-image img-fluid" src="{{ URL::to('/') }}/images/marco.jpeg" alt="" / style="height:350px;width:350px">
                @else
                     <img class="group list-group-image img-fluid" src="{{ URL::to('/') }}/images/crocodile.jpg" alt="" / style="height:350px;width:350px">
                @endif
                    
                </div>
                <div class="caption card-body">
                    <h4 class="group card-title inner list-group-item-heading">{{$products->title}}</h4>
                    <p class="group inner list-group-item-text">{{$products->description}}</p>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <p class="lead">{{$products->price}}</p>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <a class="btn btn-success" href="{{  url('/payment',$products->id ) }}">Buy Now</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
        </div>
    </div>
</div>
@endsection
