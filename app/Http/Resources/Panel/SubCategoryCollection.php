<?php

namespace App\Http\Resources\Panel;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SubCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'category_id' => $item->category_id,
                'MainCategory' => $item->category->category,
                'SubCategory' => $item->sub_category_name,
            ];
        });
    }
}
