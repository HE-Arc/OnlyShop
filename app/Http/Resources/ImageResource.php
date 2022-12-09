<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : linking the user model with the login and new account vues.

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
*/

class ImageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'imagepath' => $this->imagepath,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'item_id' => $this->item_id,
            ],
        ];
    }
}
