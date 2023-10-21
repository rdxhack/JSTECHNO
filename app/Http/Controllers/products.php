<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Cache\RedisTaggedCache;

class products extends Controller
{
    //
    public function insert_product(Request $req){
        // dd($req);
        $product=new product;
        $product->product_name=$req->prname;
        $image = $req->file('primage');
        // dd($image);
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = public_path('images');
        $path=$image->move($imagePath, $imageName);
        // dd($imagePath.$imageName);
        $product->product_image=$req->$imagePath.$imageName;
        $product->category_id=$req->cat;
        $product->save();
        return redirect('/product_list');
    }

    public function product_list(){
        // dd('lsl');
        $product_list=product::
        join('category','category.id','product.category_id')
        ->select('product.product_name','product.product_image','product.id as id','category.category_name')
        ->get();
        // dd($product_list);
        return view('/product',compact('product_list'));
    }

    public function catlist(){
        $data=category::get();
        return view('/addproduct',compact('data'));
    }
    public function catadd(Request $req){
        $data= new category;
        $data->category_name=$req->catname;
        $data->save();
        return redirect('/product_list');
    }


    public function product_del(Request $req,$id){
            // dd($id);
            $product=product::where('id',$id)->first()->delete();
           
            return back();
    }

    public function product_view($id){
       
        $product=product::
        join('category','category.id','product.category_id')
        ->where('product.id',$id)
        ->select('product.product_name','product.product_image','product.id as id','category.category_name')
        ->first();
        $data=category::get();
        // dd($product);
        return view('/viewproduct',compact('data','product'));
    }


    public function product_update(Request $req){
        // dd($req->id);
        $product=product::where('id',$req->id)->first();
        $product->product_name=$req->prname;
        $image = $req->file('primage');
        // dd($image);
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = public_path('images');
        $path=$image->move($imagePath, $imageName);
        // dd($imagePath.$imageName);
        $product->product_image=$req->$imagePath.$imageName;
        $product->category_id=$req->cat;
        $product->save();
        return redirect('/product_list');
    }


}
