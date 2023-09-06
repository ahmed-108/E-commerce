<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\categories;

use Illuminate\Http\Request;
use App\Services\CategoriesService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Contracts\View\View; 

class CategoriesController extends Controller
{
    private $categoryService;

    public function __construct(CategoriesService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $All_Categories = $this->categoryService->index();
        // return $All_Categories;
        return view('AdminPanel.MainCategories',compact(['All_Categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request, CategoriesService $CategoryService)
    {
        $validatedData = $request->validated();
        $category = $CategoryService->store($request, $validatedData);
        if ($category) {
            session()->flash('success', "Category created successfully.");
        } else {
            session()->flash('error', "Failed to create category.");
        }
        return redirect()->route('MainCategory.index');
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
    
        return redirect()->back();
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
