<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    //Inverse relation OneToMany (Comment->User)
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Inverse relation OneToMany (Comment->Article)
    public function article() {
        return $this->belongsTo(Article::class);
    }
    
}
