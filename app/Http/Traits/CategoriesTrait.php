<?php
namespace App\Http\Traits;

use App\Models\Categories;
use Illuminate\Http\Request;

trait CategoriesTrait {



    public function add_category(Request $request)
    {
        $name = $request->name;
        $sub_cat = $request->sub_category;
        $group = $request->groups;
        $image = $request->category_image;


        $category_model = new Categories();
        $category_model->category = $name;
        $category_model->sub_category = $sub_cat;
        $category_model->groups = $group;
        $category_model->save();


    }

}