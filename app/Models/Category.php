<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    //Relation OneToMany (Category->Article)
    public function article() {
        return $this->hasMany(Article::class);
    }

    public function getRouteKeyName() {
        return 'slug';
    }

}
