<?php
namespace App\Services;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Resources\Panel\CategoriesCollection;
 
class CategoriesService {
   
    public function index()
    {
        $categories =categories::paginate(10);
        return CategoriesCollection::collection($categories);
    }
    public function store(Request $request, array $categoryData)
    {
        // Handle image upload
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('images/categories', 'public');
            $categoryData['category_image'] = $imagePath;
        }

        return categories::create($categoryData);
    }
 
    public function update(Request $request, array $categoryData, categories $category)
    {
        // Handle image upload
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('images/categories', 'public');
            $categoryData['category_image'] = $imagePath;
        }

        // Update the category
        $category->update($categoryData);

        return $category;
    }
    
    public function destroy(categories $category)
    {
        if (!empty($category->category_image)) {
            File::delete(storage_path('app/public/'.$category->category_image));        
        }
        // Delete the category record
        $category->delete();
    }
} 

?>