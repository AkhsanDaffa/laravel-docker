<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JawaraCode System Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #020617; 
            color: #f8fafc; 
            font-family: 'JetBrains Mono', monospace; 
        }
        .glass { 
            background: rgba(15, 23, 42, 0.85); 
            backdrop-filter: blur(12px); 
            border: 1px solid rgba(255, 255, 255, 0.15); 
            box-shadow: 0 0 40px rgba(16, 185, 129, 0.1);
        }
        .blink { animation: blinker 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes blinker { 50% { opacity: 0; } }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-slate-950 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-slate-900 via-slate-950 to-black">

    <div class="w-full max-w-2xl p-8 mx-4 shadow-2xl glass rounded-xl border-t-4 border-emerald-500">
        <div class="flex justify-between items-center mb-8 border-b border-slate-700 pb-5">
            <div>
                <h1 class="text-3xl font-extrabold text-emerald-400 tracking-wider drop-shadow-md">SYSTEM STATUS</h1>
                <p class="text-slate-300 text-sm font-bold mt-1">DevOps Infrastructure Control</p>
            </div>
            <div class="text-right">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-950 border border-emerald-800 text-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.3)]">
                    <span class="w-2.5 h-2.5 mr-2 bg-emerald-400 rounded-full blink"></span> ONLINE
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-950/80 border-l-4 border-emerald-500 text-emerald-200 rounded text-sm font-bold shadow-lg">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-950/80 border-l-4 border-red-500 text-red-200 rounded text-sm font-bold shadow-lg">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <div class="p-5 bg-slate-900/80 rounded-lg border border-slate-700 hover:border-slate-500 transition-colors">
                <h3 class="text-xs font-extrabold text-slate-400 uppercase mb-3 tracking-widest">Application Stack</h3>
                <div class="flex items-center space-x-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" class="w-8 h-8" alt="Laravel">
                    <span class="text-xl font-bold text-white">Laravel v{{ app()->version() }}</span>
                </div>
                <div class="mt-3 text-sm font-semibold text-slate-300">PHP Version: {{ $php_version }}</div>
            </div>

            <div class="p-5 bg-slate-900/80 rounded-lg border border-slate-700 hover:border-slate-500 transition-colors">
                <h3 class="text-xs font-extrabold text-slate-400 uppercase mb-3 tracking-widest">Database Connection</h3>
                
                <div class="flex items-center justify-between w-full">
                    
                    <div class="flex items-center gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/29/Postgresql_elephant.svg" class="w-8 h-8" alt="PG">
                        <span class="text-xl font-bold text-white">PostgreSQL</span>
                    </div>

                    <div class="text-right">
                        @if(str_contains($db_status, 'Connected'))
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-emerald-950 text-emerald-400 border border-emerald-800 shadow-sm">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-400 rounded-full blink"></span>
                                CONNECTED
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-red-950 text-red-400 border border-red-800 shadow-sm">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                                ERROR
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="mt-3 text-sm font-semibold text-slate-300">DB Name: <span class="font-mono text-slate-400">{{ $db_name }}</span></div>
            </div>

            <div class="p-5 bg-slate-900/80 rounded-lg border border-slate-700 hover:border-slate-500 transition-colors">
                <h3 class="text-xs font-extrabold text-slate-400 uppercase mb-3 tracking-widest">Server Environment</h3>
                <div class="font-mono text-base font-bold text-yellow-400 tracking-tight">{{ $software }}</div>
                <div class="text-sm font-semibold text-slate-300 mt-2">IP: {{ $server_ip }}</div>
            </div>

            <div class="p-5 bg-slate-900/80 rounded-lg border border-slate-700 flex flex-col justify-center">
                <a href="/test-input" class="group w-full text-center py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold rounded-md transition-all shadow-[0_0_15px_rgba(5,150,105,0.4)] hover:shadow-[0_0_25px_rgba(5,150,105,0.6)] text-sm tracking-wide">
                    ⚡ SIMULATE TRAFFIC <br><span class="text-[10px] opacity-80 font-normal">(ADD USER TO DB)</span>
                </a>
            </div>

        </div>

        <div class="text-center border-t border-slate-700 pt-6">
            <p class="text-xs font-bold text-slate-400">
                Deployed with <span class="text-red-500 animate-pulse">❤</span> by <span class="text-white text-sm">Akhsan Daffa</span>
            </p>
            <p class="text-[10px] text-slate-500 mt-1 uppercase tracking-widest">Docker • Nginx • PostgreSQL</p>
        </div>
    </div>

</body>
</html>