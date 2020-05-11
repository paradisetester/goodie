<?php

namespace App\Http\Controllers;

    use App\category;
    use App\ProductCategory;
    use App\Product;
    use App\User;
    use Auth;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Input;
    // use Softon\SweetAlert\Facades\SWAL;
    use Redirect;
    use DB;
    use Validator;
class CategoryController extends Controller
{
   public function index(Request $request) {
    $Auth=auth()->user()->id;
    $user= User::where('id',$Auth)->first();
    if($user->role == 'admin')
    {
       $category = category::orderBy('id', 'DESC')->paginate(pagination()); 
    }
    else
    {
        $category = category::where('uid',$Auth)->paginate(pagination());
    }
    
    return view('admin.Category', compact('category'));
    }
        
    /*----- add -----*/
    public function add(Request $request) 
    {
    $Auth=auth()->user()->id;
     $user= User::where('id',$Auth)->first(); 
    if($user->role == 'admin')
    {
     $category = category::orderBy('id', 'DESC')->paginate(pagination()); 
    }
    else
    {
    $category = category::where('uid',$Auth)->paginate(pagination());
    }
    return view('admin.Category', compact('category'));
    }
        
    /*----- edit -----*/
    public function editCategory(Request $request,$ids) {
    $id = $this->decodeID($ids);
    $category = category::findOrFail($id);
    return view('admin.EditCategory', compact('category'));   
    }
        
    /*----- addCategory -----*/
    public function addCategory(Request $request) 
    {   
    $validator = Validator::make($request->all(), [ 
    'Name' => 'required', 
    'Slug' => 'required',  
    ]); 
        $Auth=auth()->user()->id;
        $category = new category;
        $category->Name = $request->input('Name');
        $category->uid =  $Auth;
        $category->Slug = $request->input('Slug');
        $category->save();
       return redirect()->back()->with('status','Category Created Successfully');
    }

        /*----- update -----*/
    public function updateCategory(Request $request) {
        $id = $request->id;
        $Auth=auth()->user()->id;
        $category = category::where('id',$Auth)->first();
        $category->Name = $request->input('Name');
        $category->uid =  $Auth;
        $category->Slug = $request->input('Slug');
        $category->save();
        return redirect()->route('category')->with('status','Category Updated Successfully');
        
    }
 
        

    public function delete($id)
    {
        $category = category::where('id', $id)->delete();  
        return redirect()->route('category')->with('status','Category Deleted Successfully');
    }
          
}
