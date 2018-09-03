<?php

namespace leroyMerlin\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Produto extends JsonResource
{
  public function toArray($request)
  {
    return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'free_shipping' => $this->free_shipping,
            'price' => $this->price ];
  }
}
