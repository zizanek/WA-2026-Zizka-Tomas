<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Knihovna - Seznam knih</title>
</head>
<body class="bg-amber-50 text-slate-800 font-sans min-h-screen">

    <header class="bg-white border-b border-amber-200 shadow-sm sticky top-0 z-10">
        <div class="max-w-5xl mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h1 class="text-2xl font-black text-amber-600 tracking-tight">
                <span class="bg-amber-100 px-2 py-1 rounded-lg">📚 Aplikace Knihovna</span>
            </h1>
            
            <nav>
                <ul class="flex gap-2">
                    <li>
                        <a href="<?= BASE_URL ?>/index.php" class="px-4 py-2 rounded-full bg-amber-500 text-white font-medium hover:bg-amber-600 transition shadow-md shadow-amber-200">
                            Seznam knih
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=book/create" class="px-4 py-2 rounded-full border-2 border-amber-500 text-amber-600 font-medium hover:bg-amber-50 transition">
                            + Přidat knihu
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="space-y-3 mb-8">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php 
                        $styles = 'bg-white border-l-4 p-4 rounded-r-xl shadow-sm';
                        if ($type === 'success') $styles .= ' border-green-500 text-green-800 bg-green-50';
                        elseif ($type === 'error') $styles .= ' border-red-500 text-red-800 bg-red-50';
                        elseif ($type === 'notice') $styles .= ' border-amber-500 text-amber-800 bg-amber-50';
                    ?>
                    
                    <?php foreach ($messages as $message): ?>
                        <div class="<?= $styles ?>" role="alert">
                            <p class="font-bold uppercase text-xs tracking-widest mb-1"><?= $type ?></p>
                            <p><?= htmlspecialchars($message) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['messages']); ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-3xl shadow-xl shadow-amber-100/50 overflow-hidden border border-amber-100">
            <div class="p-6 border-b border-amber-50 bg-amber-50/30">
                <h2 class="text-xl font-bold text-amber-900">Dostupné knihy v katalogu</h2>
            </div>

            <?php if (empty($books)): ?>
                <div class="p-12 text-center">
                    <p class="text-slate-400 italic text-lg">V databázi se zatím nenachází žádné knihy.</p>
                    <a href="<?= BASE_URL ?>/index.php?url=book/create" class="inline-block mt-4 text-amber-600 font-semibold hover:underline">Vytvořte první záznam →</a>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-sm uppercase tracking-wider">
                                <th class="px-6 py-4 font-semibold">ID</th>
                                <th class="px-6 py-4 font-semibold">Název knihy</th>
                                <th class="px-6 py-4 font-semibold">Autor</th>
                                <th class="px-6 py-4 font-semibold">Rok</th>
                                <th class="px-6 py-4 font-semibold text-right">Cena</th>
                                <th class="px-6 py-4 font-semibold text-center">Akce</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($books as $book): ?>
                                <tr class="hover:bg-amber-50/50 transition-colors">
                                    <td class="px-6 py-4 text-slate-400 font-mono text-sm">#<?= htmlspecialchars($book['id']) ?></td>
                                    <td class="px-6 py-4 font-bold text-slate-800"><?= htmlspecialchars($book['title']) ?></td>
                                    <td class="px-6 py-4 text-slate-600"><?= htmlspecialchars($book['author']) ?></td>
                                    <td class="px-6 py-4 text-slate-600"><?= htmlspecialchars($book['year']) ?></td>
                                    <td class="px-6 py-4 text-right font-semibold text-amber-700 whitespace-nowrap"><?= htmlspecialchars($book['price']) ?> Kč</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-3 text-sm">
                                            <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="text-slate-500 hover:text-amber-600 font-medium">Detail</a>
                                            <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="text-blue-500 hover:text-blue-700 font-medium">Upravit</a>
                                            <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" 
                                               onclick="return confirm('Opravdu chcete tuto knihu smazat?')"
                                               class="text-red-400 hover:text-red-600 font-medium">Smazat</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="max-w-5xl mx-auto px-4 py-12 text-center text-slate-400 text-sm">
        <div class="border-t border-amber-200 pt-6">
            <p>&copy; WA 2026 - Výukový projekt s nádechem oranžové</p>
        </div>
    </footer>

</body>
</html>