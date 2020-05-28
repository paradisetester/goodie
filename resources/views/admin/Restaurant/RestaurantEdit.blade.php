@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary cust_rst">
                  <h4 class="card-title ">Edit Restaurant</h4>
                      <a href="{{url('/restaurant/'.$Restraunt->slug)}}" class="btn btn-sm btn-success right" target="_blank"><i class="fa fa-eye"></i> View</a>
                 
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('restraunt.update')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                         <input type="hidden" name="id" value="{{$Restraunt->id}}">
              <input type="hidden" name="Assuid" value="{{$Restraunt->Assignuser}}">
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                      <div class="outter_form ">
               <div class="row">
              <div class="col-md-4">
                <div class="row">
                  <div class="form-group col-md-12">
                    <img src="{{asset('public/'.$Restraunt->image)}}" alt="Trulli" width="150" height="100">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="image">Upload Image</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" id="image" value="{{$Restraunt->image}}">
                      <label class="custom-file-label" for="image">Choose file...</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="restraunt_name">Name</label>
                          <input type="text" class="form-control" name="UserName" id="UserName" value="{{$Restraunt->UserName}}" required autocomplete="UserName">
                          @error('UserName')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                  </div>
                  <div class="form-group col-md-6">
                          <label for="videolink">Restaurant Video Link</label>
                        <input type="text" class="form-control" name="videolink" id="videolink" value="{{$Restraunt->videolink}}" required autocomplete="videolink">
                        @error('videolink')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                 </div>
                 <div class="row">
                  <div class="form-group col-md-6">
                    <label for="restraunt_name">Restaurant Name</label>
                    <input type="text" class="form-control" name="restraunt_name" id="restraunt_name" value="{{$Restraunt->restraunt_name}}" required autocomplete="restraunt_name">
                    @error('restraunt_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                          <label for="email">Email</label>
                             <input type="text" class="form-control" name="email" id="email" value="{{$Restraunt->email}}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                 </div>
                 <div class="row">
                 <div class="form-group col-md-6">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" name="password" id="password" value="{{$Restraunt->password}}" required autocomplete="password">
                          @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
            <div class="form-group col-md-6">
                        <label for="inputAddress">Address</label>
                      <input type="text" class="form-control" name="address" id="address" value="{{$Restraunt->address}}" required autocomplete="address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                 </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="contact">Contact No</label>
                        <input type="number" class="form-control" name="contact" id="contact" value="{{$Restraunt->contact}}" required autocomplete="contact">
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
            <div class="form-group col-md-6">
                          <label for="ratings">Restarunt Ratings</label>
                          <select class="form-control" name="ratings" id="ratings" value="{{$Restraunt->ratings}}" required autocomplete="ratings">
                            @if($Restraunt->ratings ==1)
                          <option value="0">0 Star</option>
                          <option value="1" selected>1 Star</option>
                          <option value="2">2 Star</option>
                          <option value="3">3 Star</option>
                          <option value="4">4 Star</option>
                          <option value="5">5 Star</option>
                            @elseif($Restraunt->ratings ==2)
                          <option value="0">0 Star</option>
                          <option value="1">1 Star</option>
                          <option value="2" selected>2 Star</option>
                          <option value="3">3 Star</option>
                          <option value="4">4 Star</option>
                          <option value="5">5 Star</option>
                          @elseif($Restraunt->ratings ==3)
                          <option value="0">0 Star</option>
                          <option value="1">1 Star</option>
                          <option value="2">2 Star</option>
                          <option value="3" selected>3 Star</option>
                          <option value="4">4 Star</option>
                          <option value="5">5 Star</option>
                          @elseif($Restraunt->ratings ==4)
                          <option value="0">0 Star</option>
                          <option value="1">1 Star</option>
                          <option value="2">2 Star</option>
                          <option value="3">3 Star</option>
                          <option value="4" selected>4 Star</option>
                          <option value="5">5 Star</option>
                          @elseif($Restraunt->ratings ==5)
                          <option value="0">0 Star</option>
                          <option value="1">1 Star</option>
                          <option value="2">2 Star</option>
                          <option value="3">3 Star</option>
                          <option value="4">4 Star</option>
                          <option value="5" selected>5 Star</option>
                          @elseif($Restraunt->ratings ==0)
                          <option value="0" selected>0 Star</option>
                          <option value="1">1 Star</option>
                          <option value="2">2 Star</option>
                          <option value="3">3 Star</option>
                          <option value="4">4 Star</option>
                          <option value="5">5 Star</option>
                          @endif
                          </select>
                           </div>
                        </div>
                  
                   <div class="row">
                      <div class="form-group col-md-12">
                      <label for="description">Description</label>
                      <textarea rows="10" class="form-control" name="description" autocomplete="off" required>{{$Restraunt->description}}</textarea>
                      </div>
                   </div>
              </div>
             </div>
                        
                        
                        
                      </div>
            <div class="submit_btn">
                      <button type="submit" class="btn btn-primary">Update</button>
            </div>
                    </form>
                </div>
              </div>
            </div>
            </div>
@endsection
@section('scripts')
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endsection