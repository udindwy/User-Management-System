<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuUser extends Model
{
    protected $table = 'MENU_USER';

    protected $primaryKey = 'no_setting';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'menu_id',
        'create_date',
        'create_time',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    protected function casts(): array
    {
        return [
            'create_date' => 'datetime',
            'create_time' => 'datetime',
            'update_date' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
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
}
