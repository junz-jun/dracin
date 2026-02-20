<?php
require_once 'config/db.php';

// Fetch trending drama for hero
$stmt = $pdo->prepare("SELECT * FROM dramas WHERE is_trending = 1 LIMIT 1");
$stmt->execute();
$trending = $stmt->fetch();

// Fetch all dramas for the list
$stmt = $pdo->query("SELECT * FROM dramas ORDER BY created_at DESC");
$dramas = $stmt->fetchAll();

// Fetch all genres
$stmt = $pdo->query("SELECT * FROM genres LIMIT 6");
$genres = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="min-h-screen">
    <main class="pt-0">
        <?php if ($trending): ?>
        <section class="relative min-h-[85vh] w-full overflow-hidden flex items-center">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover" src="<?php echo e($trending['banner_url'] ?: $trending['poster_url']); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/60 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent"></div>
            </div>
            <div class="relative w-full max-w-[1440px] mx-auto px-6 flex flex-col justify-center gap-6 pt-36 pb-28">
                <div class="flex items-center gap-2 text-primary font-bold tracking-widest text-xs uppercase">
                    <span class="material-symbols-outlined text-sm">auto_awesome</span> Trending #1 di Indonesia
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold max-w-2xl leading-[1.1] tracking-tight text-white"><?php echo e($trending['title']); ?></h1>
                <div class="flex items-center gap-4 text-slate-300 text-sm font-medium">
                    <span class="flex items-center gap-1 text-yellow-500"><span class="material-symbols-outlined text-sm fill-1">star</span> <?php echo e($trending['rating']); ?></span>
                    <span><?php echo e($trending['release_year']); ?></span>
                    <span class="px-2 py-0.5 border border-slate-700 rounded text-xs uppercase tracking-wider"><?php echo e($trending['age_rating']); ?></span>
                </div>
                <p class="text-slate-300 text-lg max-w-xl leading-relaxed"><?php echo e($trending['description']); ?></p>
                <div class="flex flex-wrap gap-4 mt-4">
                    <a href="watch.php?id=<?php echo e($trending['id']); ?>&ep=1" class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-lg font-bold flex items-center gap-2 transition-all transform hover:scale-105">
                        <span class="material-symbols-outlined fill-1">play_arrow</span> Tonton Sekarang
                    </a>
                    <a href="detail.php?id=<?php echo $trending['id']; ?>" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white px-8 py-4 rounded-lg font-bold flex items-center gap-2 transition-all">
                        <span class="material-symbols-outlined">info</span> Info Selengkapnya
                    </a>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <section class="max-w-[1440px] mx-auto px-6 -mt-12 relative z-10">
            <div class="flex gap-6 overflow-x-auto no-scrollbar pb-4">
                <a href="category.php" class="px-6 py-3 bg-primary text-white rounded-xl font-bold text-sm whitespace-nowrap shadow-xl shadow-primary/20 transition-all hover:scale-105">Semua Drama</a>
                <?php foreach ($genres as $g): ?>
                <a href="category.php?genre=<?php echo e($g['id']); ?>" class="px-6 py-3 bg-slate-900/90 hover:bg-slate-800 text-slate-100 rounded-xl font-bold text-sm whitespace-nowrap border border-white/10 backdrop-blur-md transition-all hover:scale-105">
                    <?php echo e($g['name']); ?>
                </a>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="max-w-[1440px] mx-auto px-6 py-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold tracking-tight border-l-4 border-primary pl-4">Sedang Tren</h2>
                <a href="category.php" class="text-sm font-semibold text-primary hover:underline flex items-center gap-1">Lihat Semua <span class="material-symbols-outlined text-sm">chevron_right</span></a>
            </div>
            <div class="flex gap-4 overflow-x-auto no-scrollbar pb-6 snap-x">
                <?php foreach ($dramas as $drama): ?>
                <div onclick="location.href='detail.php?id=<?php echo e($drama['id']); ?>'" class="min-w-[220px] lg:min-w-[280px] snap-start group cursor-pointer">
                    <div class="relative aspect-[2/3] rounded-xl overflow-hidden mb-3 border border-white/5 transition-transform duration-300 group-hover:scale-[1.02]">
                        <img class="w-full h-full object-cover" src="<?php echo e($drama['poster_url']); ?>"/>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-5xl">play_circle</span>
                        </div>
                    </div>
                    <h3 class="font-bold text-slate-100 group-hover:text-primary transition-colors truncate"><?php echo e($drama['title']); ?></h3>
                    <div class="flex items-center gap-2 text-xs text-slate-400 mt-1">
                        <span><?php echo e($drama['status']); ?></span> <span>•</span> <span class="flex items-center gap-0.5"><span class="material-symbols-outlined text-[10px] fill-1 text-yellow-500">star</span> <?php echo e($drama['rating']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
