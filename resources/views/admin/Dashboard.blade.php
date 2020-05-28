@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
<div class="container">
 <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title ">Restaurant Dashboard</h4>
      @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    </div>
    </div>
    <div class="row">
            <div class="col-md-3 col-xl-3">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Categories</h4><h5 class="float-left">{{$categoryCount}}</h5>
                </div>
                <div class="card-body">
                  
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xl-3">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Dishes</h4><h5>{{$ProductCount}}</h5>
                </div>
                <div class="card-body">
                  
                </div>
              </div>
            </div>
             @can('isAdmin')
             <div class="col-md-3 col-xl-3">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Category</h4><a href="{{route('category')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
                <div class="card-body">
                  
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xl-3">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Dish</h4><a href="{{route('product.add')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
                <div class="card-body">
                  
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xl-3">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Restaurant</h4><a href="{{route('restraunt.add')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
                <div class="card-body">
                  
                </div>
              </div>
            </div>
            @endcan
            </div>
@endsection

@section('scripts')
@endsection
