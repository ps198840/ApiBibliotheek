<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'year', 'author_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "books";

    /**
     * The roles that belong to the album.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
