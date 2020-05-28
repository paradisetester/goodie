@extends('layouts.master')

@section('title')
Goodiemenu
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Edit Category</h3>
        </div>
        <div class="card-body">
          <form id="" method="POST" action="{{route('category.update')}}">
          {{ csrf_field() }}
           <input type="hidden" name="id" value="{{$category->id}}"> 
          <div class="form-group">
            <label for="Name">Category Name</label>
            <input type="text" name="Name" id="Name" class="form-control" value="{{$category->Name}}" required>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection