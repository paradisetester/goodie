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
                  <h4 class="card-title ">Product Lists</h4>
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
                          Product
                        </th>
                        <th>
                          Category
                        </th>
                        <th>
                          Price
                        </th>
                        <th>
                          Image
                        </th>
                        <th>
                          Description
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        @foreach($Product as $row)
                        <tr>
                          <td>
                            {{$row->productName}}
                          </td>
                          <td>
                           {{$row->CaTegory}}
                          </td>
                          <td>
                            ${{$row->price}}
                          </td>
                          <td>
                           <img src="{{asset('public/'.$row->image)}}" alt="Trulli" width="70" height="50">
                          </td>
                          <td>
                           {{$row->description}}
                          </td>
                          <td>
                          <a href="{{url('/product/edit/'.base64_encode($row->id.'/'.time()))}}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil"></i> Edit</a>
                            @can('isAdmin')
                            <a href="{{route('product.delete',$row->id)}}" onclick="return confirm('Are you sure to delete Product?')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
                              @endcan
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                 
        </div>
         <?php echo $Product->appends(request()->except('page'))->links(); ?>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection