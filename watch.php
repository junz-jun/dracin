<?php
require_once 'config/db.php';

$id = $_GET['id'] ?? 0;
$current_ep = $_GET['ep'] ?? 1;

// Fetch drama details
$stmt = $pdo->prepare("SELECT * FROM dramas WHERE id = ?");
$stmt->execute([$id]);
$drama = $stmt->fetch();

if (!$drama) {
    die("Drama tidak ditemukan.");
}

// Fetch all episodes for the list
$stmt = $pdo->prepare("SELECT * FROM episodes WHERE drama_id = ? ORDER BY episode_number DESC");
$stmt->execute([$id]);
$episodes = $stmt->fetchAll();

// Fetch current episode details
$stmt = $pdo->prepare("SELECT * FROM episodes WHERE drama_id = ? AND episode_number = ?");
$stmt->execute([$id, $current_ep]);
$episode = $stmt->fetch();

include 'includes/header.php';
?>

<div class="min-h-screen bg-background-dark flex flex-col">
    <main class="flex-1 w-full max-w-[1440px] mx-auto p-4 lg:p-8 pt-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 xl:col-span-9 space-y-6">
                <div class="aspect-video bg-black rounded-xl overflow-hidden relative group">
                    <img class="w-full h-full object-cover opacity-80" src="<?php echo e($drama['banner_url'] ?: $drama['poster_url']); ?>"/>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center shadow-2xl cursor-pointer">
                            <span class="material-symbols-outlined text-5xl fill-1 text-white">play_arrow</span>
                        </div>
                    </div>
                    <div class="absolute bottom-0 w-full p-4 bg-gradient-to-t from-black to-transparent">
                        <div class="h-1 bg-white/20 rounded-full mb-4">
                            <div class="h-full w-[35%] bg-primary rounded-full"></div>
                        </div>
                        <div class="flex items-center justify-between text-white">
                            <div class="flex items-center gap-4"><span class="material-symbols-outlined">play_arrow</span> <span class="text-sm">14:20 / 45:00</span></div>
                            <div class="flex items-center gap-4"><span class="material-symbols-outlined">settings</span> <span class="material-symbols-outlined">fullscreen</span></div>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h1 class="text-3xl font-extrabold"><?php echo e($drama['title']); ?> - Episode <?php echo e($current_ep); ?></h1>
                    <p class="text-slate-400"><?php echo e($drama['description']); ?></p>
                </div>
            </div>
            <aside class="lg:col-span-4 xl:col-span-3">
                <div class="bg-slate-900 border border-slate-800 rounded-xl h-[600px] flex flex-col">
                    <div class="p-4 border-b border-slate-800">
                        <h3 class="font-bold">Daftar Episode</h3>
                    </div>
                    <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                        <?php foreach ($episodes as $ep): ?>
                        <a href="watch.php?id=<?php echo e($id); ?>&ep=<?php echo e($ep['episode_number']); ?>" class="flex items-center gap-3 p-2 rounded-lg cursor-pointer <?php echo $ep['episode_number'] == $current_ep ? 'bg-primary/10 border border-primary/20' : 'hover:bg-slate-800'; ?>">
                            <div class="w-24 aspect-video bg-slate-800 rounded overflow-hidden flex items-center justify-center">
                                <span class="material-symbols-outlined text-slate-500">play_circle</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold <?php echo $ep['episode_number'] == $current_ep ? 'text-primary' : 'text-white'; ?>">Episode <?php echo e($ep['episode_number']); ?></p>
                                <p class="text-xs text-slate-500"><?php echo e($ep['duration']); ?></p>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
