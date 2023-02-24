<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category) //les chambres de la categorie
    {
        $chambres= $category->chambres()->paginate(6);

        $data = [
            'title'=>$category->name,
            'category'=>$category,
            'chambres'=>$chambres,
        ];
        return view('category.show',$data);
    }
}
