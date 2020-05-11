<?php

namespace App\Http\Controllers;

    use App\category;
    use App\Product;
    use App\ProductCategory;
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
    $Restaurent_menu =Restaurent_menu::where('restaurent_menus.status',1)
    ->leftjoin('restraunts','restraunts.id','=','restaurent_menus.restaurant_id')
    ->select('restaurent_menus.*','restraunts.restraunt_name')->paginate(pagination());
    return view('admin.Menu.MenuShow',compact('Restaurent_menu'));
    }

    /*----- add -----*/
    public function add()
    {
    $Restraunt =Restraunt::all();
    $category=category::all();
    $user = User::all();
    return view('admin.Menu.MenuAdd',compact('user','category','Restraunt'));
    }
    
    public function AddMenu(Request $request) {
    $validator = Validator::make($request->all(), [ 
    'restaurant_id' => 'required', 
    'category_id' => 'required',
    ]);
    
    if ($validator->fails()) {
    Session::flash('error', $validator->messages()->first());
    return redirect()->back()->withInput();
    }
    $Restaurent_menu = new Restaurent_menu;
    $Restaurent_menu->restaurant_id = $request->input('restaurant_id');
    $tags = $request->input('category_id');
    $Restaurent_menu->category_id = implode(',', $tags);
    $Restaurent_menu->save();
    return redirect()->route('menu.lists')->with('status','Restraunt Menu Created Successfully');
    }

  
    
    /*----- edit -----*/
    public function EditMenu($ids) {
    $id = $this->decodeID($ids);
    $Restraunt =Restraunt::all();
    $category=category::all();
    $user = User::all();
    $Restaurent_menu =Restaurent_menu::where('restaurent_menus.status',1)->where('restaurent_menus.id',$id)
    ->leftjoin('restraunts','restraunts.id','=','restaurent_menus.restaurant_id')
    ->select('restaurent_menus.*','restraunts.restraunt_name')->first();
    return view('admin.Menu.MenuEdit', array('Restaurent_menu'=>$Restaurent_menu,'category'=>$category,'Restraunt'=>$Restraunt));
    }
        

    /*----- update -----*/
    public function UpdateMenu(Request $request) {
    $id = $request->id;
    $Restaurent_menu = Restaurent_menu::where('id',$id)->first();
    $Restaurent_menu->restaurant_id = $request->input('restaurant_id');
    $tags = $request->input('category_id');
    $Restaurent_menu->category_id = implode(',', $tags);
    $Restaurent_menu->save();
    return redirect()->route('menu.lists')->with('status','Restraunt Menu Updated Successfully');
    
    }
    
    public function delete($id)
    {
    $Restaurent_menu = Restaurent_menu::where('id', $id)->delete();
    return redirect()->route('menu.lists')->with('status','Restraunt Menu Deleted Successfully');
    }
}
