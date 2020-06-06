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
    use Illuminate\Support\MessageBag;
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
        return redirect()->back()->with('status','Restaurant Blocked Successfully'); 
    }
   else
    {
    return redirect()->back()->with('status','Restaurant Unblocked Successfully'); 
    }
    }
    public function addRestraunt(Request $request) {
    $validator = Validator::make($request->all(), [ 
    'UserName' => 'required',
    'restraunt_name' => 'required', 'string', 'max:255', 'unique:restraunts',
    'videolink' => 'required', 'string', 'max:255', 'unique:restraunts',
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

    $restrantname = $request->input('restraunt_name');
    $slug = str_replace(' ', '-', $restrantname);

    $user = new User;
    $user->name =$request->input('restraunt_name');
    $user->email =$request->input('email');
    $user->role = 'user';
    $user->password =Hash::make($request->password);
    $user->save();
    $Auth=auth()->user()->id;
    $Restraunt = new Restraunt;
    $Restraunt->UserName = $request->input('UserName');
    $Restraunt->firstname = $request->input('UserName');
    $Restraunt->lastname = 'null';
    $Restraunt->restraunt_name = $request->input('restraunt_name');
    $Restraunt->videolink = $request->input('videolink');
    $Restraunt->uid = $Auth;
    $Restraunt->slug = $slug;
    $Restraunt->Assignuser = $user->id;
    $Restraunt->address = $request->input('address');
    $Restraunt->zipcode = 'null';
    $Restraunt->color = $request->input('color');
    $Restraunt->contact = $request->input('contact');
    $Restraunt->ratings = $request->input('ratings');
    $Restraunt->image = fileupload($request);
    $Restraunt->description = $request->input('description');
    $Restraunt->save();
    return redirect()->route('restraunt.lists')->with('status','Restaurant Created Successfully');
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
    $ResId = Restraunt::where('id', $id)->pluck('Assignuser');
    $Restraunt = User::where('users.id',$ResId)
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
    $Restraunt->firstname = $request->input('UserName');
    $Restraunt->lastname = 'null';
    $Restraunt->restraunt_name = $request->input('restraunt_name');
    $Restraunt->videolink = $request->input('videolink');
    $restrantname = $request->input('restraunt_name');
    $slug = str_replace(' ', '-', $restrantname);
    $Restraunt->slug = $slug;
    $Restraunt->Assignuser = $Assuid;
    $Restraunt->address = $request->input('address');
    $Restraunt->zipcode = 'null';
    $Restraunt->color = $request->input('color');
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
    return redirect()->route('restraunt.lists')->with('status','Restaurant Updated Successfully');
    
    }
    
    /*----- update Restaurent Profile-----*/
    public function updaterestrauntProfile(Request $request) {
    $id = $request->id;
    $Assuid = $request->Assuid;
    $Restraunt = Restraunt::where('id',$id)->first();
    $Auth=auth()->user()->id;
    $Restraunt->uid = $Auth;
    $Restraunt->UserName = $request->input('UserName');
    $Restraunt->videolink = $request->input('videolink');
    $Restraunt->restraunt_name = $request->input('restraunt_name');
    $Restraunt->Assignuser = $Auth;
    $Restraunt->address = $request->input('address');
    $Restraunt->contact = $request->input('contact');
    $Restraunt->ratings = $request->input('ratings');
    $Restraunt->color = $request->input('color');
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
    
    return redirect()->route('dashboard')->with('status','Restaurant Updated Successfully');
    
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
    return redirect()->route('restraunt.lists')->with('status','Restaurant Deleted Successfully');
    }

    public function register(Request $request)
    {
    return view('admin.Restaurant.Register');
    }

    public static function validation($request, $id = null)
    {
        $rules = [
        'email' => 'required|email|string|max:255|unique:users',
        'restraunt_name' => 'required|string|max:255|unique:restraunts',
        'contact' => 'required|numeric|digits:10|unique:restraunts',
        ];
        if ($id) {
        $rules['email'] = 'required|email|string|max:255|unique:users,email,'.$id.',id';
        $rules['restraunt_name'] = 'required|string|max:255|unique:restraunts,restraunt_name,'.$id.',id';
        $rules['contact'] = 'required|numeric|digits:10|unique:restraunts,contact,'.$id.',id';
        }else{
        $rules['email'] = 'required|email|string|max:255|unique:users';
        $rules['restraunt_name'] = 'required|string|max:255|unique:restraunts';
        $rules['contact'] = 'required|numeric|digits:10|unique:restraunts';
        }       
        return $rules;
    }
    public function registerSave(Request $request)
    {
    $validator = Validator::make($request->all(), self::validation($request));
    if ($validator->fails()) {
    Session::flash ( 'danger', $validator->getMessageBag()->first() );
    return Redirect::back()->withInput($request->all());
    }

    $user = new User;
    $user->email =$request->input('email');
    $user->role = 'user';
    $password = randomPassword();
    $user->password = bcrypt($password);
    $user->save();
    $Auth=$user->id;
    $Restraunt = new Restraunt;
    $Restraunt->firstname = $request->input('firstname');
    $Restraunt->lastname = $request->input('lastname');
    $restrantname = $request->input('restraunt_name');
    $slug = str_replace(' ', '-', $restrantname);
    $Restraunt->restraunt_name = $restrantname;
    $Restraunt->slug = $slug;
    $Restraunt->zipcode = $request->input('zipcode');
    $Restraunt->contact = $request->input('contact');
    $Restraunt->uid = $Auth;
    $Restraunt->Assignuser = $user->id;
    $Restraunt->save();
    $emailSubject = 'Restaurant Registration Successfully';
    $title = 'Your Company Request <b>';
    $emailBody = view('Email.RegisterEmailtemplate', compact('Restraunt','user','title','password'));

    SendEmail($user->email, $emailSubject, $emailBody, [], '', '', '', '');
    // return redirect()->route('Registerform')->with('status','Restraunt Registered Successfully');
    Session::flash ( 'success', "Restaurant Registered Successfully" );
    return redirect()->route('Registerform');
    }


}
