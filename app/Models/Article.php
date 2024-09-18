<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];


    //Inverse relation OneToMany (Article->User)
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Relation OneToMany (Article->Comment)
    public function comment() {
        return $this->hasMany(Comment::class);
    }

    //Inverse relation OneToMany (Article->Category)
    public function category() {
        return $this->belongsTo(Category::class);
    }

}
