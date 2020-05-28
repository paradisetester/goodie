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
            @can('isAdmin')
            <form  id="" method="get" action="{{route('product')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}
            <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="productName">Select Restaurent</label>
                        <br>
                           <select name="rest_name"class="form-control">
                              <option value="" selected>All</option>
                                @foreach($Restraunt as $row)
                                <option value="{{$row->Assignuser}}" {{$restid == $row->Assignuser ? 'selected': ''}}>{{$row->restraunt_name}}</option>
                                @endforeach
                            </select>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                        <label for="productName">Select Category</label>
                        <br>
                           <select name="cat_name"class="form-control">
                              <option value="" selected>All</option>
                                @foreach($category as $row)
                                <option value="{{$row->id}}" {{$catid == $row->id ? 'selected': ''}}>{{$row->Name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-3 ml-auto">
                        <div class="form-group">
                           <button type="submit" class="btn btn-success">Search</button>
                        </div>
                     </div>
                     <div class="col-lg-1 col-md-1 ml-auto">
                        <div class="form-group">
                           <a href="{{route('product')}}">
                              <i class="fa fa-refresh button"></i> Reset
                              </a>
                        </div>
                     </div>
                  </div>
                  </form>
                   @endcan
                  <h4 class="card-title ">Dish Lists</h4>
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
                          Dish
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
                          Restaurent Name
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
                           {{$row->restraunt_name}}
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
@section('style')
<style>
a:link, a:visited {
  background-color: #f44336;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
} 
</style>

@endsection
@section('scripts')
@endsection