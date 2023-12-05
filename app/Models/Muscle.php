<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    use HasFactory;

    public function getMuscleCoverImageUrl()
    {
        $imageUrl_u = noImageUrl();
        $imagePath = muscleImageUploadPath() . $this->cover_image;
        $imageUrl = muscleImageUploadUrl() . $this->cover_image;
        if (isset($this->cover_image) && !empty($this->cover_image) && file_exists($imagePath)) {
            return $imageUrl;
        } else {
            $imageUrl = $imageUrl_u;
        }
        return $imageUrl;
    }

     public function getMuscleImageUrl()
    {
        $imageUrl_u = noImageUrl();
        $imagePath = muscleImageUploadPath() . $this->image;
        $imageUrl = muscleImageUploadUrl() . $this->image;
        if (isset($this->image) && !empty($this->image) && file_exists($imagePath)) {
            return $imageUrl;
        } else {
            $imageUrl = $imageUrl_u;
        }
        return $imageUrl;
    }

}
