<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'company',
        'email',
        'website',
        'location',
        'tags',
        'logo',
        'user_id'
    ];
    public function scopeFilter($query, array $filters) {
        if(request('tag')?? false) {
            // dd(request('tag'));
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if(request('search') ?? false) {
            // dd(request('search'));
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
public function user(){
    return $this->belongsTo(User::class,'user_id');
}
}
