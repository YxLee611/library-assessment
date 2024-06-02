<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'category_id',
        'date_of_publication',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
