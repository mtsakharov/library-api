<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'cover',
        'author_id',
        'librarian_id',
    ];

    /**
     * Get the book librarian resource
     * @return BelongsTo
     */
    public function librarian(): BelongsTo
    {
        return $this->belongsTo(Librarian::class);
    }

    /**
     * Get the book author resource
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the collection of book readers
     * @return BelongsToMany
     */
    public function readers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user');
    }
}
