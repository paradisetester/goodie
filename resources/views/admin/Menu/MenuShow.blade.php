@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Menu's Lists</h4>
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
                          Restaurent Name
                        </th>
                        <th>
                          Product Categories
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        @foreach($Restaurent_menu as $row)
                        <tr>
                          <td>
                            {{$row->restraunt_name}}
                          </td>
                          <td>
                           {{$row->category_id}}
                          </td>
                          <td>
                          <a href="{{url('restraunt/editMenu/'.base64_encode($row->id.'/'.time()))}}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil"></i> Edit</a>
                          <a href="{{route('restraunt.menu.delete',$row->id)}}" onclick="return confirm('Are you sure to delete Restaurent Menu ?')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php echo $Restaurent_menu->appends(request()->except('page'))->links(); ?>
              </div>
            </div>
            </div>
@endsection

@section('scripts')
@endsection