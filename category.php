<?php
require_once 'config/db.php';

// Fetch all genres
$stmt = $pdo->query("SELECT * FROM genres");
$genres = $stmt->fetchAll();

// Fetch dramas based on genre filter if set
$genre_id = $_GET['genre'] ?? null;
if ($genre_id) {
    $stmt = $pdo->prepare("SELECT d.* FROM dramas d JOIN drama_genres dg ON d.id = dg.drama_id WHERE dg.genre_id = ?");
    $stmt->execute([$genre_id]);
} else {
    $stmt = $pdo->query("SELECT * FROM dramas");
}
$dramas = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="min-h-screen bg-background-dark">
    <main class="max-w-[1440px] mx-auto px-6 py-24">
        <div class="mb-8">
            <h1 class="text-4xl font-black text-white tracking-tight">Kategori & Genre</h1>
        </div>
        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="w-full lg:w-72 flex-shrink-0">
                <div class="bg-slate-900/50 border border-slate-800 rounded-xl p-6">
                    <h3 class="font-bold text-lg mb-6">Filter</h3>
                    <form action="category.php" method="GET">
                        <div class="mb-8">
                            <h4 class="text-sm font-bold text-slate-400 uppercase mb-4">Genre</h4>
                            <div class="space-y-2">
                                <?php foreach ($genres as $g): ?>
                                <label class="flex items-center gap-3 group cursor-pointer">
                                    <input type="radio" name="genre" value="<?php echo e($g['id']); ?>" <?php echo $genre_id == $g['id'] ? 'checked' : ''; ?> class="rounded-full border-slate-700 bg-transparent text-primary focus:ring-primary"/>
                                    <span class="text-sm font-medium <?php echo $genre_id == $g['id'] ? 'text-primary' : ''; ?>"><?php echo e($g['name']); ?></span>
                                </label>
                                <?php endforeach; ?>
                                <label class="flex items-center gap-3 group cursor-pointer">
                                    <input type="radio" name="genre" value="" <?php echo !$genre_id ? 'checked' : ''; ?> class="rounded-full border-slate-700 bg-transparent text-primary focus:ring-primary"/>
                                    <span class="text-sm font-medium <?php echo !$genre_id ? 'text-primary' : ''; ?>">Semua Genre</span>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="w-full py-3 bg-primary text-white rounded-lg font-bold">Terapkan Filter</button>
                    </form>
                </div>
            </aside>
            <div class="flex-1">
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php if (empty($dramas)): ?>
                        <p class="text-slate-500 col-span-full text-center py-12">Tidak ada drama ditemukan untuk kategori ini.</p>
                    <?php endif; ?>
                    <?php foreach ($dramas as $drama): ?>
                        <div onclick="location.href='detail.php?id=<?php echo e($drama['id']); ?>'" class="group cursor-pointer">
                            <div class="relative aspect-[2/3] rounded-xl overflow-hidden mb-3 bg-slate-800">
                                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="<?php echo e($drama['poster_url']); ?>"/>
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white text-5xl">play_circle</span>
                                </div>
                            </div>
                            <h3 class="font-bold group-hover:text-primary text-slate-100 transition-colors"><?php echo e($drama['title']); ?></h3>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
