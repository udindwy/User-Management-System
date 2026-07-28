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

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" @click="if(isMobile) toggle()"
            class="flex items-center space-x-3 px-3 py-2.5 rounded-lg mb-1 transition-colors
                {{ request()->routeIs('dashboard') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span x-show="isOpen"
                x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="font-medium whitespace-nowrap text-sm">Dashboard</span>
        </a>

        {{-- Section: User --}}
        <div class="mt-6 mb-2" x-show="isOpen"
            x-transition:enter="transition ease-out duration-200 delay-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">User</div>
        </div>

        <a href="{{ route('users.index') }}" @click="if(isMobile) toggle()"
            class="flex items-center space-x-3 px-3 py-2.5 rounded-lg mb-1 transition-colors
                {{ request()->routeIs('users.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span x-show="isOpen"
                x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="font-medium whitespace-nowrap text-sm">Manajemen User</span>
        </a>

        <a href="{{ route('jenis-user.index') }}" @click="if(isMobile) toggle()"
            class="flex items-center space-x-3 px-3 py-2.5 rounded-lg mb-1 transition-colors
                {{ request()->routeIs('jenis-user.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span x-show="isOpen"
                x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="font-medium whitespace-nowrap text-sm">Jenis User</span>
        </a>

        {{-- Section: Menu --}}
        <div class="mt-6 mb-2" x-show="isOpen"
            x-transition:enter="transition ease-out duration-200 delay-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Menu</div>
        </div>

        <a href="{{ route('menus.index') }}" @click="if(isMobile) toggle()"
            class="flex items-center space-x-3 px-3 py-2.5 rounded-lg mb-1 transition-colors
                {{ request()->routeIs('menus.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span x-show="isOpen"
                x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="font-medium whitespace-nowrap text-sm">Manajemen Menu</span>
        </a>

        <a href="{{ route('menu-level.index') }}" @click="if(isMobile) toggle()"
            class="flex items-center space-x-3 px-3 py-2.5 rounded-lg mb-1 transition-colors
                {{ request()->routeIs('menu-level.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <span x-show="isOpen"
                x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="font-medium whitespace-nowrap text-sm">Level Menu</span>
        </a>

        {{-- Section: Log --}}
        <div class="mt-6 mb-2" x-show="isOpen"
            x-transition:enter="transition ease-out duration-200 delay-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Log</div>
        </div>

        <a href="{{ route('activity-log.index') }}" @click="if(isMobile) toggle()"
            class="flex items-center space-x-3 px-3 py-2.5 rounded-lg mb-1 transition-colors
                {{ request()->routeIs('activity-log.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            <span x-show="isOpen"
                x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="font-medium whitespace-nowrap text-sm">Aktivitas User</span>
        </a>

        <a href="{{ route('error-log.index') }}" @click="if(isMobile) toggle()"
            class="flex items-center space-x-3 px-3 py-2.5 rounded-lg mb-1 transition-colors
                {{ request()->routeIs('error-log.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="isOpen"
                x-transition:enter="transition ease-out duration-200 delay-75"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="font-medium whitespace-nowrap text-sm">Log Error</span>
        </a>

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
