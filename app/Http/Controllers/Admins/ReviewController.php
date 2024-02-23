<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index ()
    {
        $products = Product::where('visibility', 'Display')->paginate(5);
        return view('admins.reviews.index')->with('products', $products);
    }

    public function listComment ($id)
    {
        $product = Product::find($id);
        $reviews = $product->reviews()->paginate(5);
        return view('admins.reviews.list-reviews-by-product')->with('reviews', $reviews)->with('product', $product);
    }

    public function editProductReview ($id, $anotherId = '')
    {
        $product = Product::findOrFail($id);
        if (empty($anotherId))
        {
            return view('admins.reviews.edit')->with('product', $product);
        }
        else
        {
            $review = $product->reviews()->firstWhere('id', $anotherId);
            return view('admins.reviews.edit')->with('product', $product)->with('review', $review);
        }
    }

    public function updateProductReview (EditReviewRequest $request)
    {
        $product = Product::findOrFail($request->product_id);
        if (isset($request->id))
        {
            $review = $product->reviews()->firstWhere('id', $request->id);
            $review->update($request->all());
            return redirect('admin/review/listComment/'. $request->product_id)->with('message', 'Update Comment successfully !');
        }
        else
        {
            $product->reviews()->create($request->all());
            return redirect('admin/review/listComment/'. $request->product_id)->with('message', 'Create Comment successfully !');
        }
    }

    public function delete ($id)
    {
        $review = Review::find($id);
        $review->delete();
        return redirect('admin/review')->with('message', 'Delete Comment Successfully !');
    }
}
