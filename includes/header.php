<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>DrakorChina - Streaming Drama China Terlengkap</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1152d4",
                        "background-light": "#f6f6f8",
                        "background-dark": "#0a0a0a",
                        "card-dark": "#1e2636",
                        "accent-grey": "#92a4c9",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-nav {
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .hero-gradient {
            background: linear-gradient(180deg, rgba(16, 22, 34, 0) 0%, rgba(16, 22, 34, 0.8) 70%, rgba(16, 22, 34, 1) 100%);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #232f48; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #1152d4; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-white/5">
        <div class="max-w-[1440px] mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-12">
                <a class="flex items-center gap-2 text-primary" href="index.php">
                    <span class="material-symbols-outlined text-4xl font-bold">movie_filter</span>
                    <span class="text-2xl font-extrabold tracking-tighter text-slate-100">DRAKOR<span class="text-primary">CHINA</span></span>
                </a>
                <div class="hidden md:flex items-center gap-8">
                    <a class="text-sm font-semibold hover:text-primary transition-colors text-white" href="index.php">Beranda</a>
                    <a class="text-sm font-semibold text-slate-400 hover:text-slate-100 transition-colors" href="category.php">Kategori</a>
                    <a class="text-sm font-semibold text-slate-400 hover:text-slate-100 transition-colors" href="search.php">Populer</a>
                    <a class="text-sm font-semibold text-slate-400 hover:text-slate-100 transition-colors" href="#">Terbaru</a>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <form action="search.php" method="GET" class="relative group hidden lg:block">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <input name="q" class="bg-white/5 border border-white/10 rounded-lg py-2 pl-10 pr-4 w-64 focus:w-80 focus:ring-1 focus:ring-primary focus:border-primary transition-all outline-none text-sm placeholder:text-slate-500" placeholder="Cari drama favoritmu..." type="text"/>
                </form>
                <button class="relative p-2 text-slate-300 hover:text-white transition-colors">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full"></span>
                </button>
                <a href="profile.php" class="w-10 h-10 rounded-full bg-slate-800 border-2 border-primary/20 overflow-hidden cursor-pointer hover:border-primary transition-all">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCniDXt6b3d3OAO6TjYfizZB7OKDfJBUu6kKQdxRMjZoEANXrLqJI9iHBeOukloKhQ4whNdNjFEIf-1kOoegnJPI4q1mFisHpiY3bSrqp1uiGIMWcfFJD8IBUfrV8m9JlVnQVq4L0dO43wyFs4_QlyXoKn-9QfVKNo1rR9PkTboli0vi1nmJueHU-azKq2OXH7MuqtYxQy-bMCprgiq8bFcQ285Ji5X80ADtJrCiRHd-SE6JyKTYupoNB_ZzKTpYUjaBXP_JLGus8Qt"/>
                </a>
            </div>
        </div>
    </nav>
