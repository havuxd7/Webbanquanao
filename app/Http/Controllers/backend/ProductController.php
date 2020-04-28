<?php

namespace App\Http\Controllers\backend;
use App\models\{product,category};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{AddProductRequest,EditProductRequest};
class ProductController extends Controller
{
    function GetAddProduct()
    {
        $data['categorys']=category::all()->toarray();
        return view("backend.product.addproduct", $data);
    }
    function PostAddProduct(AddProductRequest $r)
    {
        $prd=new product;
        $prd->code=$r->code;
        $prd->name=$r->name;
        $prd->slug=$r->name;
        $prd->price=$r->price;    
        $prd->featured=$r->featured;
        $prd->state=$r->state;
        $prd->info=$r->info;
        $prd->describe=$r->describe;
        if($r->hasFile('img'))
        {
            $file=$r->img;
            $file_name=$r->name.'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$file_name);
            $prd->img=$file_name;
        }
        else
        {
            $prd->img='no-img.jpg';
        } 

        $prd->category_id=$r->category;
        $prd->save();
        return redirect('admin/product')->with('thongbao', 'Đã Thêm sản phẩm Thành Công');

    }

    function GetEditProduct($prd_id)
    {
        $data['prd']=product::find($prd_id);
        $data['categorys']=category::all()->toarray();
        return view("backend.product.editproduct", $data);
    }

   function GetListProduct()
    {
        $data['products']=product::paginate(4);
        return view("backend.product.listproduct", $data);
    }
    function PostEditProduct(EditProductRequest $r, $prd_id)
    {
        $prd=product::find($prd_id);
        $prd->code=$r->code;
        $prd->name=$r->name;
        $prd->slug=$r->name;
        $prd->price=$r->price;    
        $prd->featured=$r->featured;
        $prd->state=$r->state;
        $prd->info=$r->info;
        $prd->describe=$r->describe;
        if($r->hasFile('img'))
        {
            if($prd->img!='no-img.jpg')
            {
                unlink('backend/img/'.$prd->img);
            }
        
            $file=$r->img;
            $file_name=$r->name.'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$file_name);
            $prd->img=$file_name;
        }        
        $prd->category_id=$r->category;
        $prd->save();
        return redirect()->back()->with('thongbao', 'Đã Sửa Thành Công');
    }
    function DelProduct($prd_id)
    {
        product::destroy($prd_id);
        return redirect('admin/product')->with('thongbao', 'Đã Xóa Sản Phẩm');
    }
}
