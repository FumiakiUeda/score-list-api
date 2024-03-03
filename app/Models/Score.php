<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    /**
     * 不足しているパート譜を取得
     */
    public function part()
    {
        return $this->hasMany(Part::class);
    }
}
