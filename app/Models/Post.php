<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if($filters['search'] ?? false) {
            $searchTerms = $filters['search'];
            $query->where('title', 'like', '%' . $searchTerms . '%')
            ->orWhere('description', 'like', '%' . $searchTerms . '%');
        }

        $uriSegment = pathinfo(parse_url(url()->current(), PHP_URL_PATH), PATHINFO_BASENAME);
        session(['search' => $filters['search'] ?? false ? $filters['search'] : '']);
        session(['path' => $uriSegment]);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
