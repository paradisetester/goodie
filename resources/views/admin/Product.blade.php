@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Create Dish</h4>
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                      <form  id="" method="POST" action="{{route('product.addProduct')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                      <label for="productName">Dish Name</label>
                      <input type="text" name="productName" required="" id="productName" class="form-control"  placeholder="Enter Product name" value="<?php echo old('productName') ?>" required>
                      </div>
                      <div class="form-group">
                      <label for="productName">Select Restaurent</label>
                      <br>
                        <select class="form-control" name="uid" value="" onchange="Restrauntid(this.value)">
						 <option value="">Select Restaurent</option>
                        @foreach($user as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group" id="category">
                      <label for="Slug">Select Category</label>
                      <br>
                      @foreach($category as $cat)
                      <input type="checkbox" class="check" id="category_id" name="category_id" value="{{ $cat->id }}">
                      <label for="category_id"> {{ $cat->Name }}</label> <br>
                      @endforeach
                      </div>
                      <div class="form-group">
                      <label for="price">Price(in $)</label>
                      <input type="text" name="price"  id="price" class="form-control"  placeholder="Enter Price" value="<?php echo old('price') ?>" required>
                      </div>
                       <div class="form-group">
                        <label for="image">Upload Image</label>
                        <div class="custom-file mb-3">
                          <input type="file" class="custom-file-input" id="customFile" name="image">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                      <label for="information">Information</label>
                      <textarea rows="5" class="form-control" name="information" autocomplete="off" required></textarea>
                      </div>
                      <div class="form-group">
                      <label for="description">Description</label>
                      <textarea rows="10" class="form-control" name="description" autocomplete="off" required></textarea>
                      </div>
                      <button type="submit" class="submit_btn btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Save</button>
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
// for check one checkbox at time
$('input[type="checkbox"]').on('change', function() {
   $('input[type="checkbox"]').not(this).prop('checked', false);
});

function Restrauntid(id)
{
  console.log(id)
        $.ajax({
            url:"{{ route('product.getCategoryByRestrauntId') }}",
            method:'get',
            data:{'user_id':id},
            success:function(response)
            {
              $('#category').html(response)
              $('input[type="checkbox"]').on('change', function() {
                $('input[type="checkbox"]').not(this).prop('checked', false);
});
            }
        });
    
}
</script>
@endsection