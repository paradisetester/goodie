@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
        <form id="" method="POST" action="{{route('category.addCategory')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="Name">Category Name</label>
            <input type="text" name="Name" id="Name" class="form-control" value="<?php echo old('Name') ?>" required>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
        </form>
      </div>  
    </div>
  </div>
</div>
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Category Lists</h4>
                  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">Add</button>
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Category
                        </th>
                        <th>
                          Slug
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        @foreach($category as $row)
                        <tr>
                          <td>
                            {{$row->Name}}
                          </td>
                          <td>
                           {{$row->Slug}}
                          </td>
                          <td>
                          <a href="{{url('category/edit/'.base64_encode($row->id.'/'.time()))}}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil"></i> Edit</a>
                          <a href="{{route('category.delete',$row->id)}}" onclick="return confirm('Are you sure to delete Category?')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php echo $category->appends(request()->except('page'))->links(); ?>
              </div>
            </div>
            </div>
@endsection

@section('scripts')
@endsection