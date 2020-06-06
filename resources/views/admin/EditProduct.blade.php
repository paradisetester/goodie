@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Edit Dish</h4>
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                      <form  id="" method="POST" action="{{route('product.update')}}" enctype="multipart/form-data">
					                        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">

                      <input type="hidden" name="id" value="{{$Product->id}}">
                      
                      <div class="row">
                      <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                      <label for="productName">Dish Name</label>
                      <input type="text" name="productName" required="" id="productName" class="form-control"  placeholder="Enter Product name" value="{{$Product->productName}}" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                      <label for="productName">Select Restaurant</label>
                      <br>
                        <select class="form-control" name="uid" value="" onchange="Restrauntid(this.value)">

                        @foreach($user as $row)
                        <option value="{{ $row->id }}" {{ $ProductCategory->uid == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                        @endforeach
                        </select>
                      </div>
                      </div>
                      
                      @can('isAdmin')
                      <div class="form-group" id="category">
                      <label for="Slug">Select Category</label>
                      <br>
                      @foreach($category as $cat)
					  <div class="inner_cat">
                      <input type="checkbox" class="check" id="category_id" name="category_id" value="{{ $cat->id }}" {{ $ProductCategory->category_id==$cat->id ? 'checked' : '' }}>
                      <label for="category_id"> {{ $cat->Name }}</label>
					  </div>
                      @endforeach
                      </div>
                      @endcan
                      @can('isManager')
                      <div class="form-group" id="category">
                      <label for="Slug">Select Category</label>
                      <br>
                      @foreach($category as $cat)
					  <div class="inner_cat">
                      <input type="checkbox" class="check" id="category_id" name="category_id[]" value="{{ $cat->category_id }}" {{ $ProductCategory->category_id==$cat->category_id ? 'checked' : '' }}>
                      <label for="category_id"> {{ $cat->Name }}</label>
					  </div>
                      @endforeach
                      </div>
                      @endcan
                      <div class="form-group">
                      <label for="price">Price(in $)</label>
                      <input type="text" name="price"  id="price" class="form-control"  placeholder="Enter Price" value="{{$Product->price}}" required>
                      </div>
                      <div class="form-group">
                        <img src="{{asset('public/'.$Product->image)}}" alt="Trulli" width="150" height="100">
                      </div>
                       <div class="form-group">
                        <label for="image">Upload Image</label>
                        <div class="custom-file mb-3">
                          <input type="file" class="custom-file-input" id="customFile" name="image" value="{{$Product->image}}">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                      </div>
                      
                      <div class="row">
                      <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                      <label for="information">Information</label>
                      <textarea rows="5" class="form-control" name="information" autocomplete="off" required>{{$Product->information}}</textarea>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-12 col-12">
                      <label for="description">Description</label>
                      <textarea rows="5" class="form-control" name="description" autocomplete="off" required>{{$Product->description}}</textarea>
                      </div>
					  </div>
					  <div> 
						 <div class="extra_option">
						  <h4>Extra Option</h4>
						  </div>
					@foreach($extraProduct as $extra)
						  <div class="row delete">
							  <div class="form-group col-4">
								  <label for="price">Dish Sub Name</label>
								  <input type="text" id="title" class="form-control" value="<?php echo $extra->title;?>" required="">
							  </div>
							  <div class="form-group col-4">
								<label for="price">Dish Sub Price(in $)</label>
								<input type="text" id="Productprice" class="form-control" value="<?php echo $extra->Productprice;?>" required="">
							  </div>
							  <div class="form-group col-2">
								<a class="btn btn-success delete_pro" onclick="deleteproductrow(this,'<?php echo $extra->id?>')">Delete</a>
							  </div>
						  </div>
					@endforeach
						  <div class="append">
							
						  </div>
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
// for check one checkbox at time
$('input[type="checkbox"]').on('change', function() {
   $('input[type="checkbox"]').not(this).prop('checked', false);
});
Restrauntid('<?php echo $ProductCategory->uid; ?>');
function Restrauntid(id)
{
  console.log(id)
        $.ajax({
            url:"{{ route('product.getCategoryByRestrauntId') }}",
            method:'get',
            data:{'user_id':id,'product_id':'<?php echo $Product->id; ?>'},
            success:function(response)
            {
              $('#category').html(response)

            }
        });
    
}


$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html ='<div class="row delete">';
  html +='<div class="form-group col-4">';
  html +='<label for="price">Dish Sub Name</label>';
  html +='<input type="text" name="extra[title][]"  id="title" class="form-control"  placeholder="Enter Dish Sub Name" value="" >';
  html +='</div>';
  html +='<div class="form-group col-4">';
  html +='<label for="price">Dish Sub Price(in $)</label>';
  html +='<input type="text" name="extra[Productprice][]"  id="Productprice" class="form-control"  placeholder="Enter Dish Sub Price" value="" >';
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


function deleteproductrow(this_,id)
{
   
   var id =id;
$.ajax({
        url: '{{ url("/restaurant/delete/productoption") }}',
        type: "post",
        cache: false,
        data: {id : id, _token: $("#csrf").val()},
        success: function(dataResult){ 
          if(dataResult==1)
          {
            this_.closest('.row').remove();
          }
        }
    });

}
</script>
@endsection