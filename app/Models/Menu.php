<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'MENU';

    protected $primaryKey = 'menu_id';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'menu_id',
        'id_level',
        'menu_name',
        'menu_link',
        'menu_icon',
        'parent_id',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    protected function casts(): array
    {
        return [
            'create_date' => 'date',
            'update_date' => 'date',
        ];
    }

    public function level()
    {
        return $this->belongsTo(MenuLevel::class, 'id_level', 'id_level');
    }

    public function menuUsers()
    {
        return $this->hasMany(MenuUser::class, 'menu_id', 'menu_id');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'MENU_USER',
            'menu_id',
            'id_user',
            'menu_id',
            'id_user'
        );
    }

    public function activities()
    {
        return $this->hasMany(UserActivity::class, 'menu_id', 'menu_id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'menu_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'menu_id');
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
            'update_date' => now()->toDateString(),
        ]);
    }

    public function restore(string $restoredBy = null): bool
    {
        return $this->update([
            'delete_mark' => '0',
            'update_by'   => $restoredBy,
            'update_date' => now()->toDateString(),
        ]);
    }
}
