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
                    @if(Session::has('warning'))
                    <div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>
                    @endif
                    @if(Session::has('danger'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('danger') }}</div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                    @endif
                </div>
                <div class="card-body">
                      <form  id="" method="POST" action="{{route('product.addProduct')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      
                 <div class="row">
                    <div class="form-group col-md-6 col-sm-12 col-12">
                      <label for="productName">Dish Name</label>
                      <input type="text" name="productName" required="" id="productName" class="form-control"  placeholder="Enter Product name" value="<?php echo old('productName') ?>" required>
                      </div>
                      
                      <div class="form-group col-md-6 col-sm-12 col-12">
                      <label for="productName">Select Restaurent</label>
                        <select class="form-control" name="uid" value="" onchange="Restrauntid(this.value)">
						 <option value="">Select Restaurent</option>
                        @foreach($user as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                        </select>
                      </div>
                      </div>
                      
                      <div class="form-group" id="category">
                      <label for="Slug">Select Category</label>
                    <div class="row">
                      @foreach($category as $cat)
                      <div class="category_list col-md-3 col-sm-4 col-6">
                      <input type="checkbox" class="check" id="category_id{{ $cat->id }}" name="category_id[]" value="{{ $cat->id }}">
                      <label for="category_id{{ $cat->id }}"> {{ $cat->Name }}</label>
                      </div>
                      @endforeach
                      </div>
                      </div>
                      
                      <div class="row">
                      <div class="form-group col-md-6 col-sm-12 col-12">
                      <label for="price">Price(in $)</label>
                      <input type="text" name="price"  id="price" class="form-control"  placeholder="Enter Price" value="<?php echo old('price') ?>" required>
                      </div>
                       <div class="form-group col-md-6 col-sm-12 col-12">
                        <label for="image">Upload Image</label>
                        <div class="custom-file mb-3">
                          <input type="file" class="custom-file-input " id="customFile" name="image">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                      </div>
                      </div>
                      
                       <div class="row">
                      <div class="form-group col-md-6 col-sm-12 col-12">
                      <label for="information">Information</label>
                      <textarea rows="5" class="form-control" name="information" autocomplete="off" required></textarea>
                      </div>
                      <div class="form-group col-md-6 col-sm-12 col-12">
                      <label for="description">Description</label>
                      <textarea rows="5" class="form-control" name="description" autocomplete="off" required></textarea>
                      </div>
                      </div>
					 <div> 
						 <div class="extra_option">
						  <h4>Extra Option</h4>
						  </div>
						  <div class="append">
							
						  </div>
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
/* $('input[type="checkbox"]').on('change', function() {
   $('input[type="checkbox"]').not(this).prop('checked', false);
}); */

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
               // $('input[type="checkbox"]').not(this).prop('checked', false);
});
            }
        });
    
}

$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html ='<div class="row delete">';
  html +='<div class="form-group col-lg-4 col-md-4 col-sm-12 col-12">';
  html +='<label for="price">Dish Sub Name</label>';
  html +='<input type="text" name="extra[title][]"  id="title" class="form-control"  placeholder="Enter Dish Sub Name" value="">';
  html +='</div>';
  html +='<div class="form-group col-lg-4 col-md-4 col-sm-12 col-12">';
  html +='<label for="price">Dish Sub Price(in $)</label>';
  html +='<input type="text" name="extra[Productprice][]"  id="Productprice" class="form-control"  placeholder="Enter Dish Sub Price" value="">';
  html +='</div>';

                  


        if(number > 1)
        { 
              html +='<div class="form-group col-2">';
              html +='<button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button>';
              html += '</div>';
              html +='</div>';
            
            $('.append').append(html);
        }
        else
        {   
            html +='<div class="form-group col-2">';
            html +='<button type="button" name="add" id="add" class="btn btn-success">Add</button>';
            html += '</div>';
            html +='</div>';
            $('.append').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest(".delete").remove();
 });

$(".custom-file1-input1").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file1-label1").addClass("selected").html(fileName);
});

});
</script>
@endsection