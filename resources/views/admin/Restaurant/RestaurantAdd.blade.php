@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Create Restraunt</h4>
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('restraunt.AddRestraunt')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                      <div class="form-row">
                          <div class="form-group col-md-3">
                          <label for="restraunt_name">Name</label>
                          <input type="text" class="form-control" name="UserName" id="UserName" value="{{ old('UserName') }}" required autocomplete="UserName">
                          @error('UserName')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group col-md-3">
                          <label for="restraunt_name">Restraunt Name</label>
                          <input type="text" class="form-control" name="restraunt_name" id="restraunt_name" value="{{ old('restraunt_name') }}" required autocomplete="restraunt_name">
                          @error('restraunt_name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group col-md-3">
                          <label for="email">Email</label>
                             <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group col-md-3">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" name="password" id="password">
                          @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-8">
                        <label for="inputAddress">Address</label>
                      <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" required autocomplete="address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                      <div class="form-group col-md-4">
                        <label for="contact">Contact No</label>
                        <input type="number" class="form-control" name="contact" id="contact" value="{{ old('contact') }}" required autocomplete="contact">
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="ratings">Restarunt Ratings</label>
                          <select class="form-control" name="ratings" id="ratings" value="{{old('ratings')}}" required autocomplete="ratings">
                          <option value="0">0 Star</option>
                          <option value="1">1 Star</option>
                          <option value="2">2 Star</option>
                          <option value="3">3 Star</option>
                          <option value="4">4 Star</option>
                          <option value="5">5 Star</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">Upload Image</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image" value="{{old('image')}}" required>
                            <label class="custom-file-label" for="image">Choose file...</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                      <label for="description">Description</label>
                      <textarea rows="10" class="form-control" name="description" value="{{old('description')}}" autocomplete="off" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Create</button>
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