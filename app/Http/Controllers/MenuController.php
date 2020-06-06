<?php

namespace App\Http\Controllers;

    use App\category;
    use App\Product;
    use App\ProductCategory;
    use Illuminate\Validation\Rule;
    use App\User;
    use App\Restraunt;
    use App\Restaurent_menu;
    use Auth;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Input;
    use Redirect;
    use DB;
    use Validator;
    use Session;
    use Illuminate\Support\Facades\Hash;

class MenuController extends Controller
{
    public function index(Request $request)
     {
         $Restraunt = Restraunt::leftjoin('users', 'users.id','=','restraunts.Assignuser')
    ->select('restraunts.*','users.name as AssignedUser')->paginate(pagination());
    return view('admin.Menu.MenuShow',compact('Restraunt'));
    }

    /*----- add -----*/
    public function add(Request $request)
    { 
       
            $Restraunt= Restraunt::all();
            $category=category::all();
            $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
            ->leftjoin('categories','categories.id','=','product_categories.category_id')
            ->select('categories.Name as CaTegory','products.*')->get();
            $user = User::all();
            return view('admin.Menu.MenuAdd',compact('user','category','Restraunt','Product'));
      
         
    }
    public function AddMenu(Request $request) {
 
        $request->validate([
            'restaurant_id' => 'required',
            'category_id' => 'required',
            'orderby' => 'required',
        ]);
            
        $restaurant_id = $request->input('restaurant_id');
        
            
        
             $Restaurent = new Restaurent_menu;
             $Restaurent->category_id = $request->input('category_id');
             $Restaurent->restaurant_id = $request->input('restaurant_id');
             
             
            if (Restaurent_menu::where('restaurant_id', '=', $request->input('restaurant_id'))->where('category_id', '=', $request->input('category_id'))->where('orderby', '=', $request->input('orderby'))->exists()) {
                
              return json_encode(array(
                    "statusCode"=>201
                ));
            }
            else
            {
                $Restaurent->orderby = $request->input('orderby');
            }
             $Restaurent->save();
            $html = $this->menuList($restaurant_id);
            return json_encode(array(
                "statusCode"=>200,
                "menuList"=>$html
            ));
     // return redirect()->route('menu.lists')->with('status','Restraunt Menu Created Successfully');
    }
    
    
 public function GetMenu(Request $request) {        
            
        $restaurant_id = $request->input('restaurant_id');      
            
        $html = $this->menuList($restaurant_id);
            return json_encode(array(
                "statusCode"=>200,
                "menuList"=>$html
            ));
    }

  public function menuList($restaurant_id){
     $Restaurent_menu = Restaurent_menu::where('restaurant_id',$restaurant_id)->leftjoin('categories','categories.id','=','restaurent_menus.category_id')->select('categories.Name','restaurent_menus.*')->get();
     
     
     if($Restaurent_menu){
            $html = '<div class="table-responsive"><table class="table menu_table">';
            $html .= '<thead class=" text-primary"> <tr><th  class="srno" >Sr.No</th> <th class="names">Category</th> <th class="position">Position</th> <th class="deletbtn">Action</th> </tr></thead>';
            $i = 1;
             foreach($Restaurent_menu as $key=>$val){        
                $html .= '<tr><td class="srno">'.$i.'</td> <td class="names">'.$val->Name.'</td>  <td class="names">'.$val->orderby.'</td> <td class="deletbtn"><a class="btn btn-sm btn-outline-danger" onclick="deletemenurow(this,'.$val->id.')" title="delete"><i class="fa fa-trash"></i></a></td> </tr>';     
                $i++;
             }
             $html .= '</table></div>';
     }
     return $html;
  }
    
    /*----- edit -----*/
    public function EditMenu($ids) {
		$id = $this->decodeID($ids);
		$Restraunt =Restraunt::all();
		$category=category::all();
		$user = User::all();
			
		$Restaurent_menu =Restraunt::where('restraunts.id',$id)->leftjoin('restaurent_menus','restaurent_menus.restaurant_id','=','restraunts.id')->select('restaurent_menus.*')->pluck('restaurent_menus.category_id');
		$arrCat = array();
		foreach($Restaurent_menu as $rm){
			$arrCat[] =$rm;
		}
		return view('admin.Menu.MenuEdit', array('arrCat'=>$arrCat,'id'=>$id,'category'=>$category,'Restraunt'=>$Restraunt));
    }
        

    /*----- update -----*/
    public function UpdateMenu(Request $request) {
    
        $id = $request->id;
        $categories = $request->input('category_id');
        $restaurant_id = $request->input('restaurant_id');
        $Restaurent_menu_old = Restaurent_menu::where('restaurant_id',$restaurant_id)->get();
        
        Restaurent_menu::where('restaurant_id', $restaurant_id)->delete();
        foreach($categories as $val){
        
                $Restaurent_menu = new Restaurent_menu;
                $Restaurent_menu->restaurant_id = $restaurant_id;
                $Restaurent_menu->category_id = $val;
                $Restaurent_menu->save();   
            
        }
    return redirect()->route('menu.lists')->with('status','Restraunt Menu Updated Successfully');
    
    }
    
   
   
    public function delete($id)
    {
    $Restaurent_menu = Restaurent_menu::where('restaurant_id', $id)->delete();
    return redirect()->route('menu.lists')->with('status','Restraunt Menu Deleted Successfully');
    }

    public function deleteMenu(Request $request)
    {
       
    $id =  $request->input('id');
    $Restaurent_menu = Restaurent_menu::where('id', $id)->delete();
    return $Restaurent_menu ? 1 :0 ;
    }
}
