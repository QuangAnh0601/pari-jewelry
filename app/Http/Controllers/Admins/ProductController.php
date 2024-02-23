<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index ()
    {
        $products = Product::paginate(5);
        return view('admins.products.index')->with('products', $products);
    }

    public function create ()
    {
        $categories = Category::all();
        $stocks = Stock::all();
        return view('admins.products.create')->with('stocks', $stocks)->with('categories', $categories);
    }

    public function store(CreateProductRequest $request)
    {
        if($request->hasFile("images")){
            $images = $request->file('images');
            $fileNames = $this->saveImage($images);
        }
        $data = $request->all();
        $data['create_by'] = Auth::id();
        $stockPackages = json_decode($request->stockPackage);
        $syncStockData = [];
        $synCategoryData = [];
        foreach ($request->categories as $categoryId) {
            array_push($synCategoryData, $categoryId);
        }
        if(isset($request->id))
        {
            // dd($request->all());
            $product = Product::find($request->id);
            if($request->deleteImageId !== null)
            {
                $deleteImageIds = explode(',', $request->deleteImageId);
                // dd($deleteImageIds);
                foreach ($deleteImageIds as $deleteImageId) {
                    $deleteImage = $product->productImages->where('id', $deleteImageId)->first();
                    Storage::delete('product/'.$deleteImage->file_name);
                    $deleteImage->delete();
                    // dd('aaa');
                }
            }
            $product->update($data);
            $product->categories()->sync($synCategoryData);
            foreach($stockPackages as $stockPackage)
            {
                $syncStockData[$stockPackage->stock] = ['quantity' => $stockPackage->quantity, 'out_of_date' => $stockPackage->expired];
            }
            $product->stocks()->sync($syncStockData);
            if(isset($fileNames))
            {
                foreach ($fileNames as $fileName) {
                    $product->productImages()->create(['file_name' => $fileName]);
                }

            }
            return redirect('/admin/product')->with('message', 'Update Product Successfully !');
        }
        else
        {
            $product = Product::create($data);
            $product->categories()->sync($synCategoryData);
            foreach($stockPackages as $stockPackage)
            {
                $syncStockData[$stockPackage->stock] = ['quantity' => $stockPackage->quantity, 'out_of_date' => $stockPackage->expired];
            }
            $product->stocks()->sync($syncStockData);
            if(isset($fileNames))
            {
                foreach ($fileNames as $fileName) {
                    $product->productImages()->create(['file_name' => $fileName]);
                }

            }
            return redirect('/admin/product')->with('message', 'Create Product Successfully !');
        }
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $stocks = Stock::all();
        return view('admins.products.create')->with('product', $product)->with('stocks', $stocks)->with('categories', $categories);
    }


    public function saveImage ($iamges)
    {
        $filaNames = [];
        foreach($iamges as $image)
        {
            $fileName = md5($image->getClientOriginalName()).".". $image->getClientOriginalExtension();
            array_push($filaNames, $fileName);
            Storage::putFileAs("product" , $image, $fileName);
        }
        return $filaNames;
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('admin/product')->with('message', 'Delete Product Successfully !');
    }
}
