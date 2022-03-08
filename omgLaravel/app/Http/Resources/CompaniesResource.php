<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompaniesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'vat' => $this->vat,
            'logo' => $this->logo,
            'description' => $this->description,
            'head' => $this->head,
            'address' => $this->address,
            'user' => $this->user,
            'comments' => $this->comments,
            
        ];
        // return parent::toArray($request);
    }
}
