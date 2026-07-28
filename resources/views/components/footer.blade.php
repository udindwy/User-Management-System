<footer class="mt-auto py-5 px-4 sm:px-6 md:px-8 border-t border-slate-200 bg-white/50 backdrop-blur-sm">
    <div class="flex flex-col md:flex-row justify-between items-center gap-3">
        <div class="text-xs text-slate-500 font-medium">
            &copy; {{ date('Y') }} {{ config('app.name', 'User Management System') }}. All rights reserved.
        </div>
        <div class="text-xs text-slate-400 flex items-center space-x-4">
            <span class="hover:text-slate-600 transition-colors cursor-pointer">Privacy Policy</span>
            <span class="text-slate-300">&bull;</span>
            <span class="hover:text-slate-600 transition-colors cursor-pointer">Terms of Service</span>
            <span class="text-slate-300">&bull;</span>
            <span class="font-mono text-[10px] uppercase tracking-wider">v1.0.0</span>
        </div>
    </div>
</footer>
