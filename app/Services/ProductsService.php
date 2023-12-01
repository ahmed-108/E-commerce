<?php
namespace App\Services;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
 
class ProductsService {
   
    public function index()
    {
        $products = products::paginate(10);
        // return CategoriesCollection::collection($categories);
        return $products;
    }
    public function store(Request $request,array $productArray)
    {
        $product = products::create($productArray);
        // Handle image upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images/products', 'public');
                $imagePaths[] = $imagePath;
                $product->images()->create(['path' => $imagePath]);
            }
            $productArray['images'] = $imagePaths;        
        }
        // Return the product or a success message
        return $product;
    }

    public function update(Request $request, array $productArray, products $product)
    {
        $product->update($productArray);

        // Handle image upload
        if ($request->hasFile('images')) {
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