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
                  <h4 class="card-title ">Restaurants Lists</h4>
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
                          Restaurant Name
                        </th>
                        <th>
                          Address
                        </th>
                        <th>
                          Contact
                        </th>
                        <th>
                          Ratings
                        </th>
                        <th>
                          Image
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        @foreach($Restraunt as $row)
                        <tr>
                          <td>
                            {{$row->restraunt_name}}
                          </td>
                          <td>
                            {{$row->address}}
                          </td>
                           <td>
                            {{$row->contact}}
                          </td>
                          <td>
                              @if($row->ratings ==1)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            @elseif($row->ratings ==2)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            @elseif($row->ratings ==3)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            @elseif($row->ratings ==4)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            @elseif($row->ratings ==5)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            @elseif($row->ratings ==0)
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            @endif
                          </td>
                          <td>
                           <img src="{{asset('public/'.$row->image)}}" alt="Trulli" width="70" height="50">
                          </td>
                          <td>
                          @if($row->status==1)
                        <form method="POST" action="{{route('restraunt.status')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="status" value="0">
                            <input type="hidden" name="id" value="{{$row->Assignuser}}">
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-ban"></i> block</button>
                        </form>
                          @elseif($row->status==0)
                          <form method="POST" action="{{route('restraunt.status')}}">
                              {{ csrf_field() }}
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="id" value="{{$row->Assignuser}}">
                            <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa fa-unlock"></i> Unblock</button>
                        </form>
                          @endif
                          <a href="{{url('/restraunt/edit/'.base64_encode($row->id.'/'.time()))}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i> Edit</a>
                          <a href="{{route('restraunt.delete',$row->id)}}" onclick="return confirm('Are you sure to delete Restraunt ?')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
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

@section('style')
<style>
.checked {
  color: orange;
}
</style>
@endsection