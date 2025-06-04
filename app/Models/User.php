<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone_number',
        'role',
        'password',
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Get user profile, except admin will return null
     */
    public function getProfile()
    {
        return match ($this->role) {
            'parent' => $this->parent,
            'teacher' => $this->teacher,
            default => null,
        };
    }

    /**
     * Validation only teacher and admin that can create an event
     */
    public function canCreateEvent(): bool
    {
        return in_array($this->role, ['admin', 'teacher']);
    }

    public function parent()
    {
        return $this->hasOne(ParentModel::class); // Rename model to ParentModel to avoid PHP reserved word
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }
}
