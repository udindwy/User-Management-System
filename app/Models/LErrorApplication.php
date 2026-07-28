<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LErrorApplication extends Model
{
    protected $table = 'L_ERROR_APPLICATION';

    protected $primaryKey = 'error_id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'error_date',
        'modules',
        'controller',
        'function',
        'error_line',
        'error_message',
        'status',
        'param',
        'create_date',
        'create_time',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    protected function casts(): array
    {
        return [
            'error_date'  => 'date',
            'create_date' => 'datetime',
            'update_date' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
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

    
    public static function logException(\Throwable $e): void
    {
        try {
            $request = request();
            $route = $request->route();

            $controller = null;
            $function = null;
            $modules = $request->path();

            if ($route && $route->getAction('controller')) {
                $action = explode('@', class_basename($route->getAction('controller')));
                $controller = $action[0] ?? null;
                $function = $action[1] ?? null;
            }

            
            $idUser = auth()->check() ? auth()->user()->id_user : 'SYSTEM';

            
            $paramRaw = $request->except(['password', 'password_confirmation', 'foto']);
            $param = json_encode($paramRaw);
            if (strlen($param) > 300) {
                $param = substr($param, 0, 297) . '...';
            }
            
            $errorMsg = $e->getMessage() ?: get_class($e);
            if (strlen($errorMsg) > 1000) {
                $errorMsg = substr($errorMsg, 0, 997) . '...';
            }

            self::create([
                'id_user'       => $idUser,
                'error_date'    => now()->toDateString(),
                'modules'       => substr($modules, 0, 100),
                'controller'    => substr($controller ?? '', 0, 200),
                'function'      => substr($function ?? '', 0, 200),
                'error_line'    => (string) $e->getLine(),
                'error_message' => $errorMsg,
                'status'        => (string) $e->getCode() ?: 'ERROR',
                'param'         => $param,
                'create_date'   => now(),
                'create_time'   => now()->toTimeString(),
                'delete_mark'   => '0',
                'update_by'     => null,
                'update_date'   => null,
            ]);
        } catch (\Exception $fallback) {
            
            \Illuminate\Support\Facades\Log::error('Gagal mencatat Error Application ke DB: ' . $fallback->getMessage());
        }
    }
}
