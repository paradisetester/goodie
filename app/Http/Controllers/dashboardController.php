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
	
	$user = getCurrentUser();
	$userid = $user['id'];
	if($user['role']=='user'){
		$Restraunt = Restraunt::where('Assignuser',$userid)->first();
		$Restrauntid = $Restraunt->id;
		
		$ProductCount = ProductCategory::where('uid',$userid)->orderBy('id', 'desc')->get()->count();
		$categoryCount = Restaurent_menu::where('restaurant_id',$Restrauntid)->orderBy('id', 'desc')->get()->count();
		
		$Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
		->leftjoin('categories','categories.id','=','product_categories.category_id')->where('product_categories.product_id',$userid)
		->select('categories.Name as CaTegory','products.*')->get();
	
	}else{
		$categoryCount = category::orderBy('id', 'desc')->get()->count();
		
		$ProductCount= Product::orderBy('id', 'desc')->get()->count();
		$Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
		->leftjoin('categories','categories.id','=','product_categories.category_id')
		->select('categories.Name as CaTegory','products.*')->get();
	}
	
	
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

public function RestrauntWelcome($slug)  // Welcome page for Restraunt login users 
{
$Restraunt = Restraunt::where('slug',$slug)->first();
$Restrauntid = $Restraunt->id;
$Restrauntuid = $Restraunt->uid;
$user=User::where('id',$Restrauntuid)->first();
$RestrauntAssignid = $Restraunt->Assignuser;
$category = new category();
$ProductCategory = new ProductCategory();
$Product = Product::where('product_categories.uid',$RestrauntAssignid)->leftjoin('product_categories','product_categories.product_id','=','products.id')
->leftjoin('categories','categories.id','=','product_categories.category_id')
->select('categories.Name as CaTegory','products.*')->get();
return view('restrauntWelcome',compact('Product','Restraunt','user'));
}



public function registered(Request $request) 
{
// $user = User::where('id', '!=', auth()->id())->where('status',1)->paginate(pagination());
$Restraunt = Restraunt::leftjoin('users', 'users.id','=','restraunts.Assignuser')
    ->select('restraunts.*','users.name as AssignedUser','users.role as role','users.email as email')->paginate(pagination());
return view('admin.RegisterShow',compact('Restraunt'));
}

public function delete($id) {
$user = User::where('id', $id)->delete();
return redirect()->route('user.roles')->with('status','User Deleted Successfully');
}

}
