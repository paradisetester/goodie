<?php

namespace App\Http\Controllers;

    use App\category;
    use App\Product;
    use App\ProductCategory;
    use App\User;
    use Auth;
    use App\Restaurent_menu;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Input;
    use Redirect;
    use DB;
    use App\Restraunt;
    use Validator;

class ProductsController extends Controller
{
    public function index(Request $request)
     {
    $Auth=auth()->user()->id;
    $user= User::where('id',$Auth)->first();
    if($user->role == 'admin')
    {
    $restid = $request->input('rest_name');
    $catid = $request->input('cat_name');
    $Restraunt=Restraunt::all();
    $category = category::orderBy('id', 'desc')->get();
    $categorydata = category::orderBy('id', 'desc')->get();
    $ProductCategory = new ProductCategory();
    $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
    ->leftjoin('categories','categories.id','=','product_categories.category_id')
    ->leftjoin('restraunts','restraunts.Assignuser','=','products.uid')
    ->select('categories.Name as CaTegory','product_categories.uid','products.*','restraunts.restraunt_name')
    ->where(function($query) use($restid,$catid){
        if ($restid) 
        {
          $query->where('product_categories.uid',$restid );
       } 
        if ($catid) {
       $query->where('categories.id', $catid);
        }
        })->paginate(pagination());
    }
    else
    {
    $restid = $request->input('rest_name');
    $catid = $request->input('cat_name');
    $Restraunt=Restraunt::all();
    $category = category::orderBy('id', 'desc')->get();
    $categorydata = category::orderBy('id', 'desc')->get();
    $ProductCategory = new ProductCategory();
    // $Product = Product::where('products.uid',$Auth)
    // ->leftjoin('product_categories','product_categories.product_id','=','products.id')
    // ->leftjoin('categories','categories.id','=','product_categories.category_id')
    // ->select('categories.Name as CaTegory','products.*')->paginate(pagination());
    $ProductCategory = new ProductCategory();
    $Product = Product::where('products.uid',$Auth)->leftjoin('product_categories','product_categories.product_id','=','products.id')
    ->leftjoin('categories','categories.id','=','product_categories.category_id')
    ->leftjoin('restraunts','restraunts.Assignuser','=','products.uid')
    ->select('categories.Name as CaTegory','product_categories.uid','products.*','restraunts.restraunt_name')->paginate(pagination());
    }
    
    return view('admin.ProductIndex',compact('Product','categorydata','category','Restraunt','restid','catid'));
    }


    public function showrecord(Request $request)
     {
    $category = new category();
    $categorydata = category::orderBy('id', 'desc')->get();
    $ProductCategory = new ProductCategory();
    $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
->leftjoin('categories','categories.id','=','product_categories.category_id')
->select('categories.Name as CaTegory','products.*')->get();
    return view('Hello',compact('Product','categorydata'));
    }
        
    /*----- add -----*/
    public function add(Request $request)
    {
        
            $Auth=auth()->user()->id;
            $user= User::where('id',$Auth)->first();
            // $Restraunt = Restraunt::orderBy('id', 'desc')->get();
            $user = User::where('id', '!=', auth()->id())->where('status',1)->get();
            $category = category::orderBy('id', 'desc')->get();
            $categorydata = category::orderBy('id', 'desc')->get();
            $ProductCategory = new ProductCategory();
            $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
            ->leftjoin('categories','categories.id','=','product_categories.category_id')
            ->select('categories.Name as CaTegory','products.*')->get();
            return view('admin.Product', compact('category','categorydata','Product','user'));
        
    
    }
	
	public function getCategoryByRestrauntId(){
		
		$id = $_REQUEST['user_id'];
		$catid = '';
		if(isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id'])){
			$product_id = $_REQUEST['product_id'];
			$cat = getProductCategory($product_id);
			foreach($cat as $k=>$v){
				$catid = $k;
			}			
		}
		
		 $Restrauntid = Restraunt::where('Assignuser',$id)->pluck('id')->first();
		$categories = get_Category_by_restid($Restrauntid);
		$html='<label for="Slug">Select Category</label><br>';
		
		
        foreach($categories as $key=>$val)
        {
				$checked = '';
			if($catid == $key){
				$checked = 'checked="checked"';
			}
            $html .= '<input type="checkbox" '.$checked.' class="check" id="category_id" name="category_id" value="'.$key.'"> <label for="category_id">'.$val.'</label>'.'<br>';
        }
                
        echo $html;
	
	}
	
        
    /*----- edit -----*/
    public function editProduct($ids) {
    $id = $this->decodeID($ids);
    $user = getCurrentUser();
	$userid = $user['id'];
	if($user['role']=='user'){
         $ProductCategory = ProductCategory::where('product_id', $id)->first();
		 $user = User::where('id', $userid)->where('status',1)->get();
		 $category = category::leftjoin('product_categories as pc','pc.category_id','=','categories.id')->where('pc.uid',$userid)->get();
	}else{
		   $user = User::where('id', '!=', auth()->id())->where('status',1)->get();
		  $category = category::orderBy('id', 'desc')->get();
	}

    $Product = Product::where('id', $id)->first();
   
    $ProductCategory = ProductCategory::where('product_id', $id)->first();
   
    return view('admin.EditProduct', array('Product'=>$Product ,'category'=>$category,'ProductCategory'=>$ProductCategory,'user'=>$user)); 
    
    
    }
        
    /*----- addProduct -----*/
    public function addProduct(Request $request) 
    {   
    $validator = Validator::make($request->all(), [ 
    'productName' => 'required', 
    'price' => 'required', 
    'uid'=>'required',
    'image' => 'required', 
    'description' => 'required',
    'information' => 'information',
    ]);  
        $Auth=auth()->user()->id;
        $Product = new Product;
        $Product->uid = $request->input('uid');
        $Product->productName = $request->input('productName');
        $Product->price = $request->input('price');
        $Product->image = $this->fileupload($request);
        $Product->information = $request->input('information');
        $Product->description = $request->input('description');
        $Product->save();
        $ProductCategory = new ProductCategory;
        $ProductCategory->uid = $request->input('uid');
        $ProductCategory->category_id = $request->input('category_id');
        $ProductCategory->product_id = $Product->id;
        $ProductCategory->save();
       return redirect()->route('product')->with('status','Product Created Successfully');
    }

        /*----- update -----*/
    public function updateProduct(Request $request) {
        $id = $request->id;
        $Product = Product::where('id',$id)->first();
        $Auth=auth()->user()->id;
        // $Product->uid = $Auth;
        $Product->uid = $request->input('uid');
        $Product->productName = $request->input('productName');
        $Product->price = $request->input('price');
        if($request->hasFile('image')) 
        {
        $Product->image = $this->fileupload($request);         
        }   
        $Product->description = $request->input('description');
        $Product->information = $request->input('information');
        $Product->save();
        $ProductCategory = ProductCategory::where('product_id',$id)->first();
        // $ProductCategory->uid = $Auth;
        $ProductCategory->uid = $request->input('uid');
        $ProductCategory->category_id = $request->input('category_id');
        $ProductCategory->product_id = $Product->id;
        $ProductCategory->save();
       return redirect()->route('product')->with('status','Product Updated Successfully');
        
    }
 
    public function delete($id)
    {
        $Product = Product::where('id', $id)->delete();
        $Productcategory = ProductCategory::where('product_id', $id)->delete();
        return redirect()->route('product')->with('status','Product Deleted Successfully');
    }
}
