<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'USER';

    protected $primaryKey = 'id_user';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_user',
        'username',
        'password',
        'email',
        'no_hp',
        'wa',
        'pin',
        'id_jenis_user',
        'status_user',
        'delete_mark',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];

    protected $hidden = [
        'password',
        'pin',
    ];

    protected function casts(): array
    {
        return [
            'create_date' => 'datetime',
            'update_date' => 'datetime',
            'password'    => 'hashed',
        ];
    }

    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user', 'id_jenis_user');
    }

    public function menuUsers()
    {
        return $this->hasMany(MenuUser::class, 'id_user', 'id_user');
    }

    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'MENU_USER',
            'id_user',
            'menu_id',
            'id_user',
            'menu_id'
        );
    }

    public function fotos()
    {
        return $this->hasMany(UserFoto::class, 'id_user', 'id_user');
    }

    public function activities()
    {
        return $this->hasMany(UserActivity::class, 'id_user', 'id_user');
    }

    public function errorLogs()
    {
        return $this->hasMany(LErrorApplication::class, 'id_user', 'id_user');
    }

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('delete_mark')->orWhere('delete_mark', '!=', '1');
        });
    }

    public function scopeDeleted($query)
    {
        return $query->where('delete_mark', '1');
    }

    public function softDelete(string $deletedBy = null): bool
    {
        return $this->update([
            'delete_mark' => '1',
            'update_by'   => $deletedBy,
            'update_date' => now(),
        ]);
    }

    public function restore(string $restoredBy = null): bool
    {
        return $this->update([
            'delete_mark' => '0',
            'update_by'   => $restoredBy,
            'update_date' => now(),
        ]);
    }

    public function getAuthIdentifierName(): string
    {
        return 'id_user';
    }

    public function getAuthIdentifier(): mixed
    {
        return $this->id_user;
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    public function getAuthPasswordName(): string
    {
        return 'password';
    }
}
