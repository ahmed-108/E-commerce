<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\categories;

use Illuminate\Http\Request;
use App\Services\ProductsService;
use App\Services\CategoriesService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View; 
use Illuminate\Support\Facades\File;
use App\Services\SubCategoriesService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    private $ProductsService;
    private $CategoriesService;
    private $SubCategoriesService;

    public function __construct(ProductsService $ProductsService, CategoriesService $CategoriesService, SubCategoriesService $SubCategoriesService)
    {
        $this->ProductsService = $ProductsService;
        $this->CategoriesService = $CategoriesService;
        $this->SubCategoriesService = $SubCategoriesService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $All_Products = $this->ProductsService->index();
        $All_Categories = $this->CategoriesService->index();
        $All_SubCategories = $this->SubCategoriesService->index();
        // return $All_Categories;
        return view('AdminPanel.ManageProducts',compact(['All_Products','All_Categories','All_SubCategories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request, ProductsService $ProductsService)
    {
        $validatedData = $request->validated();
        $product = $ProductsService->store($request, $validatedData);
        if ($product) {
            session()->flash('success', "product created successfully.");
        } else {
            session()->flash('error', "Failed to create product.");
        }
        return redirect()->route('ManageProducts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, CategoriesService $CategoryService, $id)
    {
        $category = categories::find($id);

        if ($category) {
            $validatedData = $request->validated();
            $updatedCategory = $CategoryService->update($request, $validatedData, $category);
    
            if ($updatedCategory) {
                session()->flash('success', "Category updated successfully.");
            } else {
                session()->flash('error', "Failed to update category.");
            }
        } else {
            session()->flash('error', "Category not found.");
        }
    
        return redirect()->route('MainCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriesService $CategoryService,$id)
    {
        $category = categories::find($id);
        if ($category) {
            $CategoryService->destroy($category);
            session()->flash('success', "Category deleted successfully.");
        } else {
            session()->flash('error', "Category not found.");
        }
    
        return redirect()->route('MainCategory.index');
    }
}
