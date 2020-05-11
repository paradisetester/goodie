@extends('layouts.master')
@section('title')
Goodiemenu
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
                  <h4 class="card-title ">Show Register Users</h4>
                   <!--<a href="{{url('/user/add')}}" class="btn btn-primary float-right">Add</a>-->
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
                          Name
                        </th>
                        <th>
                          User Type
                        </th>
                        <th>
                          Restraunt Name
                        </th>
                        <th>
                          User Id
                        </th>
                        <th>
                        Action
                        </th>
                      </thead>
                      <tbody>
                        @foreach($Restraunt as $row)
                        <tr>
                          <td>
                            {{$row->UserName}}
                          </td>
                          <td>
                            {{$row->role}}
                          </td>
                          <td>
                            {{$row->restraunt_name}}
                          </td>
                          <td>
                            {{$row->email}}
                          </td>
                          <td>
                          <a href="{{url('/restraunt/edit/'.base64_encode($row->id.'/'.time()))}}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil"></i> Edit</a>
                          <a href="{{route('restraunt.delete',$row->id)}}" onclick="return confirm('Are you sure to delete User ?')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                 
        </div>
         <?php echo $Restraunt->appends(request()->except('page'))->links(); ?>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection