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

class RestaurantController extends Controller
{
    public function index(Request $request)
     {
    $Restraunt = Restraunt::leftjoin('users', 'users.id','=','restraunts.Assignuser')
    ->select('restraunts.*','users.name as AssignedUser')->paginate(pagination());
    return view('admin.Restaurant.RestaurantView',compact('Restraunt'));
    }


    public function status(Request $request)
    {
    $status = $request->status; 
    $id = $request->id; 
    $Restraunt= Restraunt::where('Assignuser',$id)->update(['status'=>$status]);
    $user = User::where('id',$id)->update(['status'=>$status]);
    if($status==1)
    {
        return redirect()->back()->with('status','Restraunt Blocked Successfully'); 
    }
   else
    {
    return redirect()->back()->with('status','Restraunt Unblocked Successfully'); 
    }
    }
    public function addRestraunt(Request $request) {
    $validator = Validator::make($request->all(), [ 
    'UserName' => 'required',
    'restraunt_name' => 'required', 'string', 'max:255', 
    'email' => 'required', 'string', 'email', 'max:255', 'unique:users',  
    'password' => 'required', 'string', 'min:8',
    'address' => 'required',  
    'contact' => 'required',  
    'ratings' => 'required', 
    'image' => 'required',
    'description' => 'required'
    ]);
    
    
    if ($validator->fails()) {
    Session::flash('error', $validator->messages()->first());
    return redirect()->back()->withInput();
    }
    $user = new User;
    $user->name =$request->input('restraunt_name');
    $user->email =$request->input('email');
    $user->role = 'user';
    $user->password =Hash::make($request->password);
    $user->save();
    $Auth=auth()->user()->id;
    $Restraunt = new Restraunt;
    $Restraunt->UserName = $request->input('UserName');
    $Restraunt->restraunt_name = $request->input('restraunt_name');
    $Restraunt->uid = $Auth;
    $Restraunt->Assignuser = $user->id;
    $Restraunt->address = $request->input('address');
    $Restraunt->contact = $request->input('contact');
    $Restraunt->ratings = $request->input('ratings');
    $Restraunt->image = fileupload($request);
    $Restraunt->description = $request->input('description');
    $Restraunt->save();
    return redirect()->route('restraunt.lists')->with('status','Restraunt Created Successfully');
    }

  
    /*----- add -----*/
    public function add()
    {
    $user = User::all();
    return view('admin.Restaurant.RestaurantAdd',compact('user'));
    }
 
    /*----- edit -----*/
    public function editrestraunt($ids) {
    $id = $this->decodeID($ids);
    $ResId = Restraunt::where('id', $id)->where('status',1)->pluck('Assignuser');
    $Restraunt = User::where('users.status',1)->where('users.id',$ResId)
    ->leftjoin('restraunts','restraunts.Assignuser','=','users.id')
    ->select('users.*','restraunts.*')->first();
    $user = User::all();
    return view('admin.Restaurant.RestaurantEdit', array('Restraunt'=>$Restraunt ,'user'=>$user));
    }
        

    /*----- update -----*/
    public function updaterestraunt(Request $request) {
    $id = $request->id;
    $Assuid = $request->Assuid;
    $Restraunt = Restraunt::where('id',$id)->first();
    $Auth=auth()->user()->id;
    $Restraunt->uid = $Auth;
    $Restraunt->UserName = $request->input('UserName');
    $Restraunt->restraunt_name = $request->input('restraunt_name');
    $Restraunt->Assignuser = $Assuid;
    $Restraunt->address = $request->input('address');
    $Restraunt->contact = $request->input('contact');
    $Restraunt->ratings = $request->input('ratings');
    if($request->hasFile('image')) 
    {
    $Restraunt->image = $this->fileupload($request);         
    }   
    $Restraunt->description = $request->input('description');
    $Restraunt->save();
    $user = new User;
    $user = User::where('id',$Assuid)->first();
    $user->name =$request->input('restraunt_name');
    $user->email =$request->input('email');
    $user->password =Hash::make($request->password);
    $user->save();
    return redirect()->route('restraunt.lists')->with('status','Restraunt Updated Successfully');
    
    }
    
    /*----- update Restaurent Profile-----*/
    public function updaterestrauntProfile(Request $request) {
    $id = $request->id;
    $Assuid = $request->Assuid;
    $Restraunt = Restraunt::where('id',$id)->first();
    $Auth=auth()->user()->id;
    $Restraunt->uid = $Auth;
    $Restraunt->UserName = $request->input('UserName');
    $Restraunt->restraunt_name = $request->input('restraunt_name');
    $Restraunt->Assignuser = $Auth;
    $Restraunt->address = $request->input('address');
    $Restraunt->contact = $request->input('contact');
    $Restraunt->ratings = $request->input('ratings');
    if($request->hasFile('image')) 
    {
    $Restraunt->image = $this->fileupload($request);         
    }   
    $Restraunt->description = $request->input('description');
    $Restraunt->save();
    $user = new User;
    $user = User::where('id',$Assuid)->first();
    $user->name =$request->input('restraunt_name');
    $user->email =$request->input('email');
    $user->password =Hash::make($request->password);
    $user->save();
    
    return redirect()->route('dashboard')->with('status','Restraunt Updated Successfully');
    
    }
    
    /*----- edit Restaurent profile-----*/
    public function editrestrauntProfile($ids) {
    $id = $this->decodeID($ids);
    $Restraunt = User::where('users.status',1)->where('users.id',$id)
    ->leftjoin('restraunts','restraunts.Assignuser','=','users.id')
    ->select('users.*','restraunts.*')->first();
    return view('admin.Restaurant.RestaurantProfile', array('Restraunt'=>$Restraunt));
    }
    
    public function delete($id)
    {
    $Restraunt = Restraunt::where('id', $id)->delete();
    return redirect()->route('product')->with('status','Product Deleted Successfully');
    }
}
