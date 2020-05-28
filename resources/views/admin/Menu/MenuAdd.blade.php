@extends('layouts.master')

@section('title')
Goodiemenu
@endsection
@section('content')
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
                <div class="row">
                    <div class="form-group col-md-2">
                      <button type="button" class="form-control submit_btn btn btn-primary btn-md btn-block waves-effect" value="Add Row" onclick="addRow('dataTable')">Add Row</button>
                    </div>
                    <div class="form-group col-md-2">
                      <button type="button" class="form-control submit_btn btn btn-primary btn-md btn-block waves-effect" value="Delete Row" onclick="deleteRow('dataTable')">Delete Row</button>
                    </div>
                </div>
  <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="dataTable">
                      <thead class=" text-primary">
                        <th>
                        Checkbox
                        </th>
                        <th>
                        Category
                        </th>
                        <th>
                          Category Order
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <INPUT type="checkbox"  name="chk"/>
                          </td>
                          <td>
                           <select class="form-control category_id" id="category_id" name="category_id" value="" >
                        <option value="">Select Category</option>
                        @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->Name }}</option>
                        @endforeach
                        </select>
                          </td>
                          <td>
                       <INPUT type="text" class="form-control" name="txt"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                    
                </div>
              </div>
            </div>
            </div>
@endsection

@section('scripts')
<script>

function addRow(tableID) {
var rowmenu= 
              '<td>'+
              '<INPUT type="checkbox"  name="chk"/>'+
              '</td>'+
              '<td>'+
              '<select class="form-control category_id" id="category_id" name="category_id" value="" >'+
              '<option value="">Select Category</option>'+
              '@foreach($category as $cat)'+
              '<option value="{{ $cat->id }}">{{ $cat->Name }}</option>'+
              '@endforeach'+
              '</select>'+
              '</td>'+
              '<td>'+
              '<INPUT type="text" class="form-control" name="txt"/>'+
              '</td>'
      var table = document.getElementById(tableID);
      console.log(document.getElementById(tableID))

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

        var newcell = row.insertCell(i);

        

        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch(newcell.childNodes[0].type) {
          case "text":
              newcell.childNodes[0].value = "";
              break;
          case "checkbox":
              newcell.childNodes[0].checked = false;
              break;
          case "select-one":
              newcell.childNodes[0].selectedIndex = 0;
              break;
        }
      }
    }

    function deleteRow(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          if(rowCount <= 1) {
            alert("Cannot delete all the rows.");
            break;
          }
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
      }catch(e) {
        alert(e);
      }
    }

function category(id)
{
  console.log(id)
        $.ajax({
            url:"{{ route('menu.add') }}",
            method:'get',
            data:{'user_id':id},
            success:function(response)
            {
              $('#category').html(response)
            }
        });
    
}
</script>
@endsection