@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
<div class="container">
 <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title ">Restaurant DASHBOARD</h4>
      @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    </div>
    </div>
    <div class="row">
            <div class="col-md-6 col-xl-3">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h3 class="card-title ">Categories</h3><h4 class="float-left">{{$categoryCount}}</h4>
                </div>
                <div class="card-body">
                  
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h3 class="card-title ">Products</h3><h4>{{$ProductCount}}</h4>
                </div>
                <div class="card-body">
                  
                </div>
              </div>
            </div>
            </div>
@endsection

@section('scripts')
@endsection
