<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

//nama2 field yang akan diisi oleh pengguna/sistem, bukan default dari database
//id dan timestamps : diisi default ole database, jd tidak di daftarkan di sini
#[Fillable(['cover', 'title', 'price', 'description', 'language', 'publisher', 'writer', 'release_date', 'page_of_book', 'book_category_id'])]
class Book extends Model
{
    //nama tunggal tanpa e/es karena book_categories berperam sebagai one
    //pada relasi one to many milik kategori book
    public function bookCategory(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function checkoutBooks(): HasMany
    {
        return $this->hasMany(checkoutBook::class);
    }

    public function subscriptionPackageBooks(): HasMany
    {
        return $this->hasMany(SubscriptionPackageBook::class);
    }
}
