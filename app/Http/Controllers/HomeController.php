<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\category;
    use App\Product;
    use App\ProductCategory;
    use App\User;
    use Illuminate\Support\Facades\Input;
    // use Softon\SweetAlert\Facades\SWAL;
    use Redirect;
    use DB;
    use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function productShow(Request $request)
     {
    $category = new category();
    $categorydata = category::orderBy('id', 'desc')->get();
    $ProductCategory = new ProductCategory();
    $Product = Product::leftjoin('product_categories','product_categories.product_id','=','products.id')
    ->leftjoin('categories','categories.id','=','product_categories.category_id')
    ->select('categories.Name as CaTegory','products.*')->get();
    // return view('Product.Index', compact('Product'));
    return view('welcome',compact('Product','categorydata'));
}
}
