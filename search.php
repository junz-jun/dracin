<?php
require_once 'config/db.php';

$query = $_GET['q'] ?? '';

if (!empty($query)) {
    $stmt = $pdo->prepare("SELECT * FROM dramas WHERE title LIKE ?");
    $stmt->execute(['%' . $query . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM dramas ORDER BY rating DESC LIMIT 12");
}
$results = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="min-h-screen bg-background-dark">
    <main class="max-w-7xl mx-auto px-6 py-24">
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h1 class="text-white text-3xl font-black">
                    <?php echo !empty($query) ? 'Hasil Pencarian' : 'Populer'; ?>
                </h1>
                <?php if (!empty($query)): ?>
                <p class="text-slate-500">Hasil untuk: <span class="text-primary italic">"<?php echo e($query); ?>"</span></p>
                <?php endif; ?>
            </div>
            <div class="w-full md:w-auto lg:hidden">
                <form action="search.php" method="GET" class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <input name="q" value="<?php echo e($query); ?>" class="bg-white/5 border border-white/10 rounded-lg py-2 pl-10 pr-4 w-full focus:ring-1 focus:ring-primary focus:border-primary transition-all outline-none text-sm placeholder:text-slate-500" placeholder="Cari drama..." type="text"/>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <?php if (empty($results)): ?>
                <p class="text-slate-500 col-span-full text-center py-12">Tidak ada drama ditemukan.</p>
            <?php endif; ?>
            <?php foreach ($results as $drama): ?>
                <div onclick="location.href='detail.php?id=<?php echo e($drama['id']); ?>'" class="group flex flex-col gap-3 cursor-pointer">
                    <div class="relative aspect-[3/4] overflow-hidden rounded-xl bg-slate-800 shadow-lg">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-all" src="<?php echo e($drama['poster_url']); ?>"/>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-5xl">play_circle</span>
                        </div>
                    </div>
                    <h3 class="font-bold text-sm text-slate-100 group-hover:text-primary transition-colors"><?php echo e($drama['title']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
