<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\Product;
use App\ProductCategory;
use App\User;
use App\Restraunt;
use App\Restaurent_menu;
use Illuminate\Support\Facades\Input;
use Redirect;
use DB;
use Session;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class dashboardController extends Controller
{
public function index(Request $request) //this is for Admin Dashboard
{
$category = new category();
$categoryCount = category::orderBy('id', 'desc')->get()->count();
$ProductCategory = new ProductCategory();
$ProductCount= Product::orderBy('id', 'desc')->get()->count();
$Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
->leftjoin('categories','categories.id','=','product_categories.category_id')
->select('categories.Name as CaTegory','products.*')->get();
return view('admin.Dashboard',compact('Product','categoryCount','ProductCount'));
}

public function welcome(Request $request)  //this is for Welcome page (without login)
{
$category = new category();
$categorydata = category::orderBy('id', 'desc')->get();
$ProductCategory = new ProductCategory();
$Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
->leftjoin('categories','categories.id','=','product_categories.category_id')
->select('categories.Name as CaTegory','products.*')->get();
return view('welcome',compact('Product','categorydata'));
}
public function registered(Request $request) 
{
// $user = User::where('id', '!=', auth()->id())->where('status',1)->paginate(pagination());
$Restraunt = Restraunt::leftjoin('users', 'users.id','=','restraunts.Assignuser')
    ->select('restraunts.*','users.name as AssignedUser','users.role as role','users.email as email')->paginate(pagination());
return view('admin.RegisterShow',compact('Restraunt'));
}
public function editRole($ids)
{
$id = $this->decodeID($ids);
$user = User::where('id', $id)->first();
return view('admin.EditRegister',compact('user'));
}
/*----- add -----*/
public function add()
{
return view('admin.RegisterUser');
}
public function addRole(Request $request) {
$validator= Validator::make($request->all(), [ 
'name' => 'required', 'string', 'max:255', 
'email' => 'required', 'string', 'email', 'max:255', 'unique:users',  
'password' => 'required', 'string', 'min:8', 'confirmed'
]);

if ($validator->fails()) {
Session::flash('error', $validator->messages()->first());
return redirect()->back()->withInput();
}
$user = new User;
$user->name =$request->input('name');
$user->email =$request->input('email');
$user->password =Hash::make($request->password);
$user->save();
return redirect()->route('user.roles')->with('status','User Created Successfully'); 
}
public function updateRole(Request $request) {
$id = $request->id;
$user = User::where('id', $id)->first();
$user->name = $request->input('name');
$user->email = $request->input('email');
$user->role = $request->input('role');
$user->save();
return redirect()->route('user.roles')->with('status','Roles Updated Successfully');

}
public function delete($id) {
$user = User::where('id', $id)->delete();
return redirect()->route('user.roles')->with('status','User Deleted Successfully');
}

}
