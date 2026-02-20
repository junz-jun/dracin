<?php
require_once 'config/db.php';

// Fetch the first user for profile
$stmt = $pdo->query("SELECT * FROM users LIMIT 1");
$user = $stmt->fetch();

if (!$user) {
    // Fallback if no user in DB
    $user = [
        'username' => 'Pengguna',
        'email' => 'user@example.com',
        'avatar_url' => 'https://via.placeholder.com/150',
        'joined_at' => date('Y-m-d H:i:s')
    ];
}

include 'includes/header.php';
?>

<div class="min-h-screen bg-background-dark">
    <main class="max-w-[1440px] mx-auto w-full px-6 py-24 flex flex-col lg:flex-row gap-8">
        <aside class="w-full lg:w-64 flex flex-col gap-6">
            <h1 class="text-white text-2xl font-bold">Profil Saya</h1>
            <nav class="flex flex-col gap-1">
                <button class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white text-left"><span class="material-symbols-outlined">person</span> Akun</button>
                <button class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-400 text-left"><span class="material-symbols-outlined">payments</span> Langganan</button>
                <button class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 text-slate-400 text-left"><span class="material-symbols-outlined">history</span> Riwayat</button>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col gap-8">
            <section class="bg-slate-900 rounded-3xl p-6 border border-slate-800 flex flex-col md:flex-row items-center gap-6">
                <div class="size-32 rounded-full ring-4 ring-primary bg-cover bg-center" style="background-image: url('<?php echo e($user['avatar_url']); ?>')"></div>
                <div class="text-center md:text-left">
                    <h3 class="text-2xl font-bold text-white"><?php echo e($user['username']); ?></h3>
                    <p class="text-slate-500">ID: <?php echo 8829000 + $user['id']; ?> • Bergabung <?php echo e(date('M Y', strtotime($user['joined_at']))); ?></p>
                    <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-2">
                        <button class="bg-primary px-5 py-2 rounded-xl text-sm font-semibold text-white">Edit Profil</button>
                        <button class="bg-slate-800 px-5 py-2 rounded-xl text-sm font-semibold text-white">VIP Pass</button>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-slate-900/50 p-6 rounded-2xl border border-white/5">
                    <h4 class="text-slate-400 text-sm font-bold uppercase mb-4">Informasi Akun</h4>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Email</p>
                            <p class="text-white font-medium"><?php echo e($user['email']); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Status Langganan</p>
                            <p class="text-primary font-bold">Gratis</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
