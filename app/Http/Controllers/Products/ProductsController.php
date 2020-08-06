<?php
namespace App\Http\Controllers\Products;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function VIEW_INDEX()
    {

        return view('products.index');
        
    }
    public function VIEW_CREATE()
    {
        
        return view('products.create');
        
    }
    public function VIEW_SHOW()
    {
        return view('products.show');
        
    }
    public function VIEW_EDIT()
    {
        
        return view('products.edit');
        
    }
    public function VIEW_CATEGORY()

    {
        
        return view('products.category');
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('q') != null) {

            $products['data'] = Product::where('title', 'like', '%' . request('q') . '%')->orWhere('description', 'like', '%' . request('q') . '%')->orWhere('subtitle', 'like', '%' . request('q') . '%')->inRandomOrder()->with('categories')->get();

            return response()->json(['products' => $products], 200);
        }else {
            
            $auth = Auth::user();

            $role_auth = $auth->roles->pluck('name');

            $products = Product::with('categories')->inRandomOrder()->paginate(6);
            
            $categories = Category::all();

            return ['products' => $products, 'categories' => $categories, 'auth' => $role_auth];
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return ['categories' => $categories];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

        $product = $request->validate([
             'title' => 'required',
             'description' => 'required',
             'slug' => 'required',
             'subtitle' => 'required',
             'price' => 'required',
             'image' => 'required',
             'images' => 'required',
         ]);
        if(strlen($request->image) > 200)
        {
            $image = $request->get('image');
            $name = time().'.jpg';
            \Image::make($request->get('image'))->save(public_path('images/').$name);
            $sendImage = '/images/'.$name;
        }
        if(is_array($request->images))
        {
            $tab = [];
            $i = 0;
            $images = $request->get('images');
            foreach($images as $item)
            {
                
                $names = time().'.jpg';

                \Image::make($item)->save(public_path('images/').$i.''.$names);
                array_push($tab, '/images/'.$i.''.$names);
                
                $i++;
            }
            
            $sendImages = serialize($tab);
        }
        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'subtitle' => $request->subtitle,
            'price' => $request->price,
            'image' => $sendImage,
            'images' => $sendImages,
            
        ])->categories()->attach([
            $request->category_id[0],
            $request->category_id[1]
        ]);

        return response()->json(['Create product success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return ['product' => $product];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $categories = Category::all();

        $categoriesProduct = $product->categories->pluck("id");

        return ['product', $product, 'categories' => $categories, 'categoriesProduct' => $categoriesProduct];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $product = Product::find($product);

        $product->categories()->sync($request->categories);
        $product->title = $request->title;
        $product->subtitle = $request->subtitle;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->slug = $request->slug;
        $product->image = $request->image;
        $product->images = $request->images;

        
        if(strlen($request->image) > 200)
        {
            $image = $request->get('image');
            $name = time().'.jpg';
            \Image::make($request->get('image'))->save(public_path('images/').$name);
            $product->image = '/images/'.$name;
        }
        if(is_array($request->images))
        {
            $tab = [];
            $i = 0;
            $images = $request->get('images');
            foreach($images as $item)
            {
                
                $names = time().'.jpg';

                \Image::make($item)->save(public_path('images/').$i.''.$names);
                array_push($tab, '/images/'.$i.''.$names);
                
                $i++;
            }
            
            $product->images = serialize($tab);
        }
        


        $product->save();
        
        return response()->json("add image and multipleImage succes");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getCategory($slug) {

        if(request('q') != null) {

            $categoryWithSlug = Category::where('slug', $slug)->firstOrFail();
            
            $productByCategories['data'] = $categoryWithSlug->products()->with('categories')->where('title', 'like', '%' . request('q') . '%')->orWhere('description', 'like', '%' . request('q') . '%')->orWhere('subtitle', 'like', '%' . request('q') . '%')->inRandomOrder()->get();

            return response()->json(['productByCategories' => $productByCategories], 200);
        }else {
            $categories = Category::all();

            $categoryWithSlug = Category::where('slug', $slug)->firstOrFail();
    
            $productByCategories = $categoryWithSlug->products()->with('categories')->paginate(6);
    
            return response()->json(['productByCategories' => $productByCategories, 'categories' => $categories], 200);
        }
        
    }
}
