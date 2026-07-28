<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        
    }

    
    public function boot(): void
    {
        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\Login::class,
            function ($event) {
                \App\Models\UserActivity::log('Login', 'User berhasil login ke sistem');
            }
        );

        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\Logout::class,
            function ($event) {
                
                
                if ($event->user) {
                    \App\Models\UserActivity::create([
                        'id_user' => $event->user->id_user,
                        'status' => 'Logout',
                        'diskripsi' => 'User berhasil logout dari sistem',
                        'menu_id' => null,
                        'create_by' => $event->user->id_user,
                        'create_date' => now(),
                        'delete_mark' => '0',
                    ]);
                }
            }
        );
    }
}
