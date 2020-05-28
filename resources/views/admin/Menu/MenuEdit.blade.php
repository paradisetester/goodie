@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Edit Menu</h4>
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form  id="" method="POST" action="{{route('restraunt.updateMenu')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$id}}">
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Restaurant</label>
                    <br>
                        <select class="form-control" name="restaurant_id" value="" required>
                        @foreach($Restraunt as $row)
                        <option value="{{ $row->id }}" <?=($row->id==$id)?'selected':'';?>>{{ $row->restraunt_name }}</option>
                        @endforeach
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="category_id">Choose Categories</label>
                    <br>
				
                      @foreach($category as $cat)
					  <?php if(in_array($cat->id, $arrCat)){ $checked = 'checked="checked"'; } else{  $checked = ''; }?>
					  
					  <input type="checkbox" class="check" id="category_id" name="category_id[]" <?=$checked?> value="{{ $cat->id }}">
                      <label for="category_id"> {{ $cat->Name }}</label>
                      @endforeach
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
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endsection