<?php

namespace App\Http\Repositories;

use App\Models\Category;


class CategoryRepository
{
    public function listCategory ()
    {
        $categories = Category::where('visibility', 'Display')->get();
        return $categories;
    }
}

?>