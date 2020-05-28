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
        // if(request()->ajax())
        // {
        //     $id =$request->user_id;
        //     $Restraunt = Restraunt::where('id',$id)->first();
        //     $assignid =$Restraunt->Assignuser;
        //     $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
        //                 ->leftjoin('categories','categories.id','=','product_categories.category_id')
        //                 ->select('categories.Name as CaTegory','products.*','categories.id')->where('product_categories.uid',$assignid)->get();
        //     $html='<label for="category_id">Choose Categories</label><br>';
        //     foreach($Product as $cat)
        //     {
        //         $html .= '<input type="checkbox" class="check" id="category_id" name="category_id[]" value="'.$cat->CaTegory.'"> <label for="category_id">'.$cat->CaTegory.'</label> ';
                
        //     }
        //     echo $html;
        // }

        // else
        // {
            $Restraunt= Restraunt::all();
            $category=category::all();
            $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
            ->leftjoin('categories','categories.id','=','product_categories.category_id')
            ->select('categories.Name as CaTegory','products.*')->get();
            $user = User::all();
            return view('admin.Menu.MenuAdd',compact('user','category','Restraunt','Product'));
        // }
         
    }
    public function AddMenu(Request $request) {
 //        return 'hit me';
	// 	$validator = Validator::make($request->all(), [ 
	// 		'restaurant_id' => ['required', 'unique:restaurent_menus'],
	// 		'category_id' => 'required',
	// 	]);
    
 //    if ($validator->fails()) {
 //    Session::flash('error', $validator->messages()->first());
 //    return redirect()->back()->withErrors($validator)
 //        ->withInput();
 //    }
	// $restaurant_id = $request->input('restaurant_id');
 //    $menus = $request->input('category_id');
 //    foreach ($menus as $menu) {
	// 	$Restaurent_menu = Restaurent_menu::where('category_id',$menu)->where('restaurant_id',$restaurant_id)->first();
	
	// 		if(empty($Restaurent_menu)){
				
	// 			$Restaurent = new Restaurent_menu;
	// 			$Restaurent->restaurant_id = $request->input('restaurant_id');
	// 			$Restaurent->category_id = $menu;
	// 			$Restaurent->save();	
	// 		}else{
	// 			 return redirect()->route('menu.lists')->with('status','This category already exist for this menu');
	// 		}
		
 //    }
        $request->validate([
            'restaurant_id' => 'required',
            'category_id' => 'required',
            'orderby' => 'required',
        ]);
             $Restaurent = new Restaurent_menu;
             $Restaurent->restaurant_id = $request->input('restaurant_id');
             $Restaurent->category_id = $request->input('category_id');
             return $Restaurent->orderby = $request->input('orderby');
             $Restaurent->save();
        return json_encode(array(
            "statusCode"=>200
        ));
     // return redirect()->route('menu.lists')->with('status','Restraunt Menu Created Successfully');
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
        return $id;
    $Restaurent_menu = Restaurent_menu::where('restaurant_id', $id)->delete();
    return redirect()->route('menu.lists')->with('status','Restraunt Menu Deleted Successfully');
    }
}
