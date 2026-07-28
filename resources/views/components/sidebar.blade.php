<aside x-data="sidebarData()" x-on:toggle-sidebar.window="toggle()"
    class="fixed top-0 left-0 z-40 h-screen bg-slate-900 text-white overflow-hidden flex flex-col transition-all duration-300"
    :class="isOpen ? 'w-64' : 'w-0 md:w-20'">

    <div class="h-16 flex items-center justify-center border-b border-slate-800 px-4 flex-shrink-0">
        <div x-show="isOpen"
            x-transition:enter="transition ease-out duration-200 delay-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-gradient-primary rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <div class="font-heading font-bold text-sm leading-tight">User Management</div>
                <div class="text-xs text-slate-400">Admin Panel</div>
            </div>
        </div>
        <div x-show="!isOpen"
            x-transition:enter="transition ease-out duration-200 delay-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="w-8 h-8 bg-gradient-primary rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-2 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-slate-800">

        @if(isset($groupedMenus))
            @foreach($groupedMenus as $groupName => $menus)
                {{-- Section Header --}}
                <div class="mt-4 mb-2" x-show="isOpen"
                    x-transition:enter="transition ease-out duration-200 delay-100"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <div class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">{{ $groupName }}</div>
                </div>

                @foreach($menus as $menu)
                    @php
                        // Cek apakah request route saat ini cocok dengan link menu.
                        // Karena link menu mungkin berupa path (/users) atau nama route (users.index).
                        $isActive = false;
                        $link = $menu->menu_link;
                        
                        // Menangani base path jika menu link mengarah ke root /
                        if ($link === '/') {
                            $isActive = request()->is('/');
                        } else {
                            // Trim leading slash for 'is()' matching
                            $cleanLink = ltrim($link, '/');
                            $isActive = request()->is($cleanLink) || request()->is($cleanLink . '/*');
                        }
                    @endphp
                    
                    <a href="{{ Str::startsWith($link, ['http', '/']) ? url($link) : route($link) }}" 
                        @click="if(isMobile) toggle()"
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-lg mb-1 transition-colors
                            {{ $isActive ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        
                        <div class="w-5 h-5 flex-shrink-0 flex items-center justify-center">
                            @if($menu->menu_icon)
                                {{-- Jika ada mekanisme render icon, bisa diletakkan di sini. Karena kita belum punya komponen <x-icon>, kita tampilkan inisial/fallback --}}
                                <span class="text-[10px] font-mono font-bold leading-none">{{ strtoupper(substr(str_replace('lucide-', '', $menu->menu_icon), 0, 2)) }}</span>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            @endif
                        </div>
                        
                        <span x-show="isOpen"
                            x-transition:enter="transition ease-out duration-200 delay-75"
                            x-transition:enter-start="opacity-0 -translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="font-medium whitespace-nowrap text-sm">{{ $menu->menu_name }}</span>
                    </a>
                @endforeach
            @endforeach
        @endif

    </nav>

    <div class="border-t border-slate-800 p-2 flex-shrink-0">
        <button @click="toggle()"
            class="w-full flex items-center justify-center px-3 py-2 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-colors"
            :title="isOpen ? 'Collapse sidebar' : 'Expand sidebar'">
            <svg class="w-5 h-5 transition-transform duration-300"
                :class="isOpen ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

</aside>

<div x-data="overlayData()" @toggle-sidebar.window="updateShow()" x-show="show" x-cloak
    @click="$dispatch('toggle-sidebar')"
    class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 md:hidden"
    x-transition:enter="transition-opacity ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
</div>

<script>
    document.addEventListener('alpine:init', () => {
        const savedState = localStorage.getItem('sidebarOpen');
        const isMobile = window.innerWidth < 768;
        const initialState = savedState !== null ? savedState === 'true' : !isMobile;

        Alpine.store('sidebar', {
            isOpen: initialState,

            toggle() {
                this.isOpen = !this.isOpen;
                localStorage.setItem('sidebarOpen', this.isOpen);
            }
        });
    });

    function sidebarData() {
        return {
            get isOpen() {
                return Alpine.store('sidebar') ? Alpine.store('sidebar').isOpen : (window.innerWidth >= 768);
            },

            get isMobile() {
                return window.innerWidth < 768;
            },

            toggle() {
                if (Alpine.store('sidebar')) {
                    Alpine.store('sidebar').toggle();
                }
            }
        };
    }

    function overlayData() {
        return {
            show: false,

            updateShow() {
                const isMobile = window.innerWidth < 768;
                this.show = isMobile && Alpine.store('sidebar') && Alpine.store('sidebar').isOpen;
            }
        };
    }
</script>
