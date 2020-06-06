@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')

<style>

.itemrow {
    width: 100%;
    display: flex;
}

.menulist_heading {
    font-size: 22px;
    font-weight: 500;
    margin-top: 34px;
    margin-bottom: 20px;
}

</style>
 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Create Menu</h4>
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-warning">
                    <ul>
                    @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                      <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                  <div class="form-group ">
                    <label for="exampleFormControlSelect1">Select Restaurant</label>
                    <br>
                    <div class="cust-select">
                        <select class="form-control restaurant_id" id="restaurant_id" name="restaurant_id" value="" >
                        <option value="">Select Restaurant</option>
                        @foreach($Restraunt as $row)
                        <option value="{{ $row->id }}">{{ $row->restraunt_name }}</option>
                        @endforeach
                        </select>
                        </div>
                  </div>
            <div class="row append">
            <div class="itemrow">
            <div class="Category1 categorydiv col-md-6">
            <div class="form-group cust-select" id="category">
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
        
        
                  </div>
                </div>
        
              </div>
            </div>
            </div>
@endsection

@section('scripts')
<script>
  
 $(document).on('change','.restaurant_id',function(){
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
   });
   
   
   
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
@endsection
@section('scripts')
<script>

var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "cust-select":*/
x = document.getElementsByClassName("cust-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
@endsection