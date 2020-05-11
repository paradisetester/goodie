@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Edit Roles</h4>
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('user.update')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-group">
                    <label for="formGroupExampleInput">User Name</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="name" value="{{$user->name}}" placeholder="Example input">
                    </div>
                    <div class="form-group">
                    <label for="formGroupExampleInput2">Email</label>
                    <input type="email" name="email" class="form-control" id="formGroupExampleInput2" value="{{$user->email}}" placeholder="Another input">
                    </div>
                    <div class="form-group">
                    <label for="formGroupExampleInput2">Give Roles</label>
                        <select class="form-control" name="role" required autocomplete="off">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        </select>
                    </div>
                    <button type="submit" class="submit_btn btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Update</button>
                    </form>
                </div>
              </div>
            </div>
            </div>
@endsection

@section('scripts')
<script>
</script>
@endsection