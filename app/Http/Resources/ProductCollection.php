<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'code'=>$this->code,
            'slug'=>$this->slug,
            'description'=>$this->description,
            'cost'=>$this->cost,
            'price'=>$this->price,
            'image'=>asset('uploads/product/'.$this->image),
            'is_featured'=>$this->is_featured,
            'is_published'=>$this->is_published,
            'tax_id'=>$this->tax_id,
            'brand_id'=>$this->brand_id,
            'unit_id'=>$this->unit_id,
            'category_id'=>$this->category_id,
            'productStock'=> new  ProductStockCollection($this->productStock)
        ];
    }
}
