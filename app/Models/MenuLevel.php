<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLevel extends Model
{
    protected $table = 'MENU_LEVEL';

    protected $primaryKey = 'id_level';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_level',
        'level',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_level', 'id_level');
    }
}
