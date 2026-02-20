<?php
require_once 'config/db.php';

$id = $_GET['id'] ?? 0;

// Fetch drama details
$stmt = $pdo->prepare("SELECT * FROM dramas WHERE id = ?");
$stmt->execute([$id]);
$drama = $stmt->fetch();

if (!$drama) {
    die("Drama tidak ditemukan.");
}

// Fetch episodes
$stmt = $pdo->prepare("SELECT * FROM episodes WHERE drama_id = ? ORDER BY episode_number ASC");
$stmt->execute([$id]);
$episodes = $stmt->fetchAll();

// Fetch genres
$stmt = $pdo->prepare("SELECT g.name FROM genres g JOIN drama_genres dg ON g.id = dg.genre_id WHERE dg.drama_id = ?");
$stmt->execute([$id]);
$genres = $stmt->fetchAll(PDO::FETCH_COLUMN);

include 'includes/header.php';
?>

<div class="bg-background-dark min-h-screen">
    <main class="w-full pt-20">
        <section class="relative w-full h-[70vh] min-h-[500px] overflow-hidden">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover" src="<?php echo e($drama['banner_url'] ?: $drama['poster_url']); ?>"/>
                <div class="absolute inset-0 hero-gradient"></div>
            </div>
            <div class="relative h-full max-w-7xl mx-auto px-6 lg:px-20 flex flex-col justify-end pb-12">
                <div class="flex flex-col md:flex-row gap-8 items-end">
                    <div class="hidden md:block w-64 aspect-[2/3] rounded-xl overflow-hidden shadow-2xl border border-white/10 flex-shrink-0 mb-[-40px]">
                        <img class="w-full h-full object-cover" src="<?php echo e($drama['poster_url']); ?>"/>
                    </div>
                    <div class="flex-1 space-y-4">
                        <div class="flex flex-wrap items-center gap-3">
                            <?php if ($drama['is_trending']): ?>
                            <span class="bg-primary px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wider">Trending</span>
                            <?php endif; ?>
                            <span class="text-yellow-400 flex items-center gap-1 font-bold"><span class="material-symbols-outlined fill-1 text-lg">star</span> <?php echo e($drama['rating']); ?></span>
                            <span class="text-accent-grey text-sm font-medium"><?php echo e($drama['release_year']); ?> • <?php echo e($drama['total_episodes']); ?> Episodes • <?php echo e($drama['age_rating']); ?></span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight"><?php echo e($drama['title']); ?></h1>
                        <p class="text-slate-300 text-lg leading-relaxed max-w-2xl"><?php echo e($drama['description']); ?></p>
                        <div class="flex flex-wrap gap-4 pt-4">
                            <?php if (!empty($episodes)): ?>
                            <a href="watch.php?id=<?php echo e($drama['id']); ?>&ep=<?php echo e($episodes[0]['episode_number']); ?>" class="bg-primary hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold flex items-center gap-2 shadow-lg">
                                <span class="material-symbols-outlined fill-1">play_arrow</span> Tonton Episode 1
                            </a>
                            <?php endif; ?>
                            <button class="bg-white/10 hover:bg-white/20 text-white px-8 py-3 rounded-lg font-bold flex items-center gap-2 border border-white/10">
                                <span class="material-symbols-outlined">add</span> Simpan ke Watchlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 lg:px-20 py-16 grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-12">
                <div class="flex border-b border-white/10 gap-8">
                    <button class="pb-4 text-primary border-b-2 border-primary font-bold text-lg">Episodes</button>
                    <button class="pb-4 text-accent-grey font-medium text-lg">Reviews</button>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <?php foreach ($episodes as $ep): ?>
                    <a href="watch.php?id=<?php echo e($drama['id']); ?>&ep=<?php echo e($ep['episode_number']); ?>" class="group cursor-pointer relative bg-primary/10 border border-primary/30 rounded-xl overflow-hidden aspect-video">
                        <img class="w-full h-full object-cover <?php echo $ep['thumbnail_url'] ? 'opacity-60' : 'hidden'; ?>" src="<?php echo e($ep['thumbnail_url']); ?>"/>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl text-primary">play_circle</span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/80 to-transparent">
                            <p class="text-sm font-semibold text-white">Episode <?php echo e($ep['episode_number']); ?></p>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="space-y-8">
                <div>
                    <h3 class="text-white font-bold mb-4">Informasi</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b border-white/5 pb-2">
                            <span class="text-slate-500">Status</span>
                            <span class="text-slate-200"><?php echo e($drama['status']); ?></span>
                        </div>
                        <div class="flex justify-between border-b border-white/5 pb-2">
                            <span class="text-slate-500">Tahun Rilis</span>
                            <span class="text-slate-200"><?php echo e($drama['release_year']); ?></span>
                        </div>
                        <div class="flex justify-between border-b border-white/5 pb-2">
                            <span class="text-slate-500">Genre</span>
                            <span class="text-slate-200 text-right"><?php echo e(implode(', ', $genres)); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
