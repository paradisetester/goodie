@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
<style>.itemrow {
    width: 100%;
    display: flex;
}

.menulist_heading {
    font-size: 22px;
    font-weight: 500;
    margin-top: 34px;
    margin-bottom: 20px;
}

.menulist_heading {}

</style>
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
              <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="hidden" name="id" value="{{$id}}">
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Restaurant</label>
                    <br>
                        <select class="form-control restaurant_id" id="restaurant_id" name="restaurant_id" value="" required>
                        @foreach($Restraunt as $row)
                        <option value="{{ $row->id }}" <?=($row->id==$id)?'selected':'';?>>{{ $row->restraunt_name }}</option>
                        @endforeach
                        </select>
                  </div>
                 
                    <div class="row append">
            <div class="itemrow">
            <div class="Category1 categorydiv col-md-6">
            <div class="form-group " id="category">
            <label for="category_id">Choose Categories</label>
            <br>
            <select class="form-control category_id" id="category_id" name="category_id" value="" >
            <option value="">Select Category</option>
            @foreach($category as $cat)
            <option value="{{ $cat->id }}">{{ $cat->Name }}</option>
            @endforeach
            </select>
            </div>
            </div>
            <div class="form-group col-md-4" id="category">
            <label for="category_id">Category Order</label>
            <input type="number" name="orderby"  id="orderby" class="form-control orderby"  placeholder="Enter Order No" value="" >
            </div>
            <div class="form-group col-md-2" id="category">
            <a class="submit_btn btn btn-primary btn-md btn-block waves-effect">Add More</a>
            </div>

            </div>
            </div> 

            <div class="menulist_section" >
            <div class="menulist_heading">Menus List</div>
            <div class="menulist"></div>
            </div>
                </form>
                </div>
              </div>
            </div>
            </div>
@endsection

@section('scripts')

<script>
  onloadmenu();
 $(document).on('change','.restaurant_id',function(){
    onloadmenu();
   });
   
   function onloadmenu(){
     var restaurant_id = $('#restaurant_id').val();

       $.ajax({
              url: '<?php echo route('restraunt.GetMenu') ?>',
              type: "POST",
              data: {
                _token: $("#csrf").val(),
                restaurant_id: restaurant_id
              },
              cache: false,
              success: function(dataResult){
               
                var obj = jQuery.parseJSON( dataResult );
                 if(obj.statusCode==200){
                
                 $('.menulist').html(obj.menuList);
                 }                         
              }
          });
   }
   
$(document).on('click','.submit_btn',function(){
  var restaurant_id = $('#restaurant_id').val();
  var category_id = $(this).parents('.itemrow').find('.category_id').val();
  var orderby = $(this).parents('.itemrow').find('.orderby').val();
  
  
  if(restaurant_id!="" && category_id!="" && orderby!="" ){
        $.ajax({
              url: '<?php echo route('restraunt.AddMenu') ?>',
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  restaurant_id: restaurant_id,
                  category_id: category_id,
                  orderby: orderby
              },
              cache: false,
              success: function(dataResult){
           var obj = jQuery.parseJSON( dataResult );
           if(obj.statusCode==200){
           
           $('.menulist').html(obj.menuList);
           }
                  else if(obj.statusCode==201){
                     swal("Cancelled!", "Menu Already Exist!", "error");
                  }else{
             swal("Cancelled!", "Error contact with administrator!", "error");
          }   
               
        }
    });
          
  }
});

function deletemenurow(this_,id)
{
   // this_.closest('tr').remove();
   var id =id;
$.ajax({
        url: '{{ url("/restaurant/delete/Menuoption") }}',
        type: "post",
        cache: false,
        data: {id : id, _token: $("#csrf").val()},
        success: function(dataResult){ 
          if(dataResult==1)
          {
            this_.closest('tr').remove();
          }
        }
    });

}
</script>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endsection