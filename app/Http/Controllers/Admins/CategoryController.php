<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category::paginate(5);
        return view('admins.Categories.index')->with('categories', $categories);
    }

    public function edit ($id = '')
    {
        if(!empty($id)){
            $category = Category::find($id);
            return view('admins.Categories.edit')->with('category', $category);
        }
        else
        {
            return view('admins.Categories.edit');
        }
    }

    public function update (EditCategoryRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('thumbnail'))
        {
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
        }
        $data['create_by'] = Auth::id();
        if(isset($request->id))
        {
            $category = Category::find($request->id);
            if ($category->thumbnail != 'no-image.png') {
                Storage::delete('categories/'. $category->thumbnail);
            }
            $category->update($data);
            return redirect('/admin/Category')->with('message', 'Update Category successfully !');
        }
        else
        {
            Category::create($data);
            return redirect('/admin/Category')->with('message', 'Create Category successfully !');
        }
    }

    public function delete ($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/admin/Category')->with('message', 'Delete Category successfully !');
    }

    public function saveImage ($image)
    {
        $fileName = md5($image->getClientOriginalName().time()). "." . $image->getClientOriginalExtension();
        $image = Image::make($image);
        $croppedImage = $image->fit(800, 800);
        $croppedImage->encode('jpg'); // Encode ảnh thành định dạng jpg (hoặc định dạng khác tuỳ ý)
        $encodedImage = $croppedImage->encoded;
        
        $filePath = 'categories/' . $fileName;
        Storage::put($filePath, $encodedImage);
        return $fileName;
    }

    public function cropImage (Request $request)
    {
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image = Image::make($image);

            $maxSize = max($image->width(), $image->height());

            // Cắt ảnh thành hình vuông
            $croppedImage = $image->fit(800, 800);

            $croppedImage->encode('data-url'); // Encode ảnh thành định dạng jpg (hoặc định dạng khác tuỳ ý)
            $croppedImageBase64 = $croppedImage->encoded;
            
            return response()->json([
                'image_base64' => $croppedImageBase64
            ], 200);
        }
    }
}
