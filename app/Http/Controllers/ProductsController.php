<?php

namespace App\Http\Controllers;

    use App\category;
    use App\Product;
    use App\ProductCategory;
    use App\User;
    use Auth;
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
    $category = category::orderBy('id', 'desc')->get();
    $categorydata = category::orderBy('id', 'desc')->get();
    $ProductCategory = new ProductCategory();
    $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
    ->leftjoin('categories','categories.id','=','product_categories.category_id')
    ->select('categories.Name as CaTegory','products.*')->paginate(pagination());
    }
    else
    {
    $category = category::orderBy('id', 'desc')->get();
    $categorydata = category::orderBy('id', 'desc')->get();
    $ProductCategory = new ProductCategory();
    $Product = Product::where('products.uid',$Auth)
    ->leftjoin('product_categories','product_categories.product_id','=','products.id')
    ->leftjoin('categories','categories.id','=','product_categories.category_id')
    ->select('categories.Name as CaTegory','products.*')->paginate(pagination());
    }
    
    return view('admin.ProductIndex',compact('Product','categorydata','category'));
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
    public function add()
    {
    $Auth=auth()->user()->id;
    $user= User::where('id',$Auth)->first();
    if($user->role == 'admin')
    {
    // $Restraunt = Restraunt::orderBy('id', 'desc')->get();
    $user = User::where('id', '!=', auth()->id())->where('status',1)->get();
    $category = category::orderBy('id', 'desc')->get();
    $categorydata = category::orderBy('id', 'desc')->get();
    $ProductCategory = new ProductCategory();
    $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
    ->leftjoin('categories','categories.id','=','product_categories.category_id')
    ->select('categories.Name as CaTegory','products.*')->get();
    }
    else
    {
    $category = category::where('uid',$Auth)->orderBy('id', 'desc')->get();
    $categorydata = category::where('uid',$Auth)->orderBy('id', 'desc')->get();
    $ProductCategory = new ProductCategory();
    $Product = Product::where('products.uid',$Auth)
    ->leftjoin('product_categories','product_categories.product_id','=','products.id')
    ->leftjoin('categories','categories.id','=','product_categories.category_id')
    ->select('categories.Name as CaTegory','products.*')->paginate(pagination());
    }  
    return view('admin.Product', compact('category','categorydata','Product','user'));
    }
        
    /*----- edit -----*/
    public function editProduct($ids) {
    $id = $this->decodeID($ids);
    $Product = Product::where('id', $id)->first();
    $category = category::orderBy('id', 'desc')->get();
    $ProductCategory = ProductCategory::where('product_id', $id)->first();
    return view('admin.EditProduct', array('Product'=>$Product ,'category'=>$category,'ProductCategory'=>$ProductCategory)); 
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
    ]);  
        $Auth=auth()->user()->id;
        $Product = new Product;
        $Product->uid = $request->input('uid');
        $Product->productName = $request->input('productName');
        $Product->price = $request->input('price');
        $Product->image = $this->fileupload($request);
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
        $Product->uid = $Auth;
        $Product->productName = $request->input('productName');
        $Product->price = $request->input('price');
        if($request->hasFile('image')) 
        {
        $Product->image = $this->fileupload($request);         
        }   
        $Product->description = $request->input('description');
        $Product->save();
        $ProductCategory = ProductCategory::where('product_id',$id)->first();
        $ProductCategory->uid = $Auth;
        $ProductCategory->category_id = $request->input('category_id');
        $ProductCategory->product_id = $Product->id;
        $ProductCategory->save();
       return redirect()->route('product')->with('status','Product Updated Successfully');
        
    }
 
    public function delete($id)
    {
        $Product = Product::where('id', $id)->delete();
        return redirect()->route('product')->with('status','Product Deleted Successfully');
    }
}
