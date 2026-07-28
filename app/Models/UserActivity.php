<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $table = 'USER_ACTIVITY';

    protected $primaryKey = 'no_activity';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'diskripsi',
        'status',
        'menu_id',
        'delete_mark',
        'create_by',
        'create_date',
    ];

    protected function casts(): array
    {
        return [
            'create_date' => 'datetime',
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

    public function softDelete(): bool
    {
        return $this->update([
            'delete_mark' => '1',
        ]);
    }

    public function restore(): bool
    {
        return $this->update([
            'delete_mark' => '0',
        ]);
    }

    
    public static function log(string $status, string $description, ?string $menuId = null): void
    {
        if (auth()->check()) {
            self::create([
                'id_user' => auth()->user()->id_user,
                'status' => $status,
                'diskripsi' => $description,
                'menu_id' => $menuId,
                'create_by' => auth()->user()->id_user,
                'create_date' => now(),
                'delete_mark' => '0',
            ]);
        }
    }
}
