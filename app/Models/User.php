<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'display_image',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function saved_articles()
    {
        return $this->belongsToMany(Article::class, 'user_saved_articles', 'user_id', 'article_id');
    }

    public function saved_article($article_id)
    {
        return $this->saved_articles()->where('article_id', $article_id)->count() > 0;
    }

    public function can_write_article()
    {
        return in_array(Auth::user()->type, [UserType::WRITER->value]) || Auth::user()->admin;
    }

    public function getDisplayImageAttribute(): string
    {
        return $this->image && file_exists('storage/' . $this->image) ? asset('storage/' . $this->image) : asset('front/images/no-profile-image.webp');
    }

    public function getFullNameAttribute() : string
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
