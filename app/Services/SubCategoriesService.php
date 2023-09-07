<?php
namespace App\Services;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\sub_categories;
use App\Http\Resources\Panel\SubCategoryCollection;
 
class SubCategoriesService {
   
    public function index()
    {
        $sub_categories =sub_categories::with('category')->paginate(10);
        return new SubCategoryCollection($sub_categories);
        // return $sub_categories;
    }
    public function store(array $SubCategoryData)
    {
        return sub_categories::create($SubCategoryData);
    }
 
    public function update(array $SubCategoryData, sub_categories $SubCategory)
    {
        // Update the Sub Category
        $SubCategory->update($SubCategoryData);

        return $SubCategory;
    }
    
    public function destroy(sub_categories $SubCategory)
    {

        // Delete the sub category record
        $SubCategory->delete();
    }
} 

?>