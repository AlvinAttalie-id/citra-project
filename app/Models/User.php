<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'email',
        'password',
        'name',
        'alamat',
        'no_hp',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relationships
    public function suplayBarang()
    {
        return $this->hasMany(SuplayBarang::class, 'id_user', 'id_user');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_user', 'id_user');
    }

    // Relationships
    public function canAccessPanel(Panel $panel): bool
    {
        return true; // izinkan semua user
    }
}
