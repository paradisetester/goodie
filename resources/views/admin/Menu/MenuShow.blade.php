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
                          User Name
                        </th>
                        <th>
                          Restaurant Name
                        </th>
                        <th>
                          Dish Categories
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
                            {{$row->restraunt_name}}
                          </td>
                          <td><?php  $categorydata = get_Category_by_restid($row->id); ?>
                           @foreach($categorydata as $category)
                                     <span >{{$category}} ,</span>
                             @endforeach
                          </td>
                          <td>
                          <a href="{{url('restaurant/editMenu/'.base64_encode($row->id.'/'.time()))}}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil"></i></a>
                          <a href="{{route('restraunt.menu.delete',$row->id)}}" onclick="return confirm('Are you sure to delete Restaurant Menu ?')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
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
@endsection

@section('scripts')
@endsection