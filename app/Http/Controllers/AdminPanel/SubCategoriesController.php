<?php

namespace App\Http\Controllers\AdminPanel;

use view;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\sub_categories;
use App\Http\Controllers\Controller;
use App\Services\SubCategoriesService;
use App\Http\Requests\SubCategoriesRequest;

class SubCategoriesController extends Controller
{
    private $SubCategoryService;

    public function __construct(SubCategoriesService $SubCategoryService)
    {
        $this->SubCategoryService = $SubCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $All_Sub_Categories = $this->SubCategoryService->index();
        $main_categories = categories::all();
        $data = [
            'All_Sub_Categories'=> $All_Sub_Categories->toArray($All_Sub_Categories),
            'main_categories'=> $main_categories
        ];
        return view('AdminPanel.SubCategories',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoriesRequest $request, SubCategoriesService $SubCategoryService)
    {
        $validatedData = $request->validated();
        $SubCategory = $SubCategoryService->store($validatedData);
        if ($SubCategory) {
            session()->flash('success', "Sub Category created successfully.");
        } else {
            session()->flash('error', "Failed to create Sub Category.");
        }
        return redirect()->route('SubCategory.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sub_categories  $sub_categories
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoriesRequest $request, SubCategoriesService $SubCategoryService, $id)
    {
        $SubCategory = sub_categories::find($id);

        if ($SubCategory) {
            $validatedData = $request->validated();
            $updatedSubCategory = $SubCategoryService->update($validatedData, $SubCategory);
    
            if ($updatedSubCategory) {
                session()->flash('success', "Sub Category updated successfully.");
            } else {
                session()->flash('error', "Failed to update Sub Category.");
            }
        } else {
            session()->flash('error', "Sub Category not found.");
        }
    
        return redirect()->route('SubCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sub_categories  $sub_categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SubCategoriesService $SubCategoryService)
    {
        $SubCategory = sub_categories::find($id);
        if ($SubCategory) {
            $SubCategoryService->destroy($SubCategory);
            session()->flash('success', "Sub Category deleted successfully.");
        } else {
            session()->flash('error', "Sub Category not found.");
        }
        return redirect()->route('SubCategory.index');
    }
}
