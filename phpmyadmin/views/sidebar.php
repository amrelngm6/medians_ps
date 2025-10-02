<!-- Sidebar -->
<div class="sidebar w-80 bg-white border-r border-gray-200 flex flex-col">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-database text-blue-600"></i>
            Database Manager
        </h1>
        <p class="text-sm text-gray-500 mt-1">Modern & Professional</p>
    </div>

    <!-- Database List -->
    <div class="flex-1 overflow-y-auto p-4">
        <div class="mb-4">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-sm font-semibold text-gray-700 uppercase">Databases</h2>
                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full"><?php echo count($databases); ?></span>
            </div>
            <div class="space-y-1">
                <?php foreach ($databases as $db): ?>
                    <?php 
                    $isActive = $db === $selectedDatabase;
                    $bgClass = $isActive ? 'bg-blue-50 border-blue-500 text-blue-700' : 'hover:bg-gray-50 border-transparent text-gray-700';
                    ?>
                    <a href="?database=<?php echo urlencode($db); ?>" 
                       class="block px-3 py-2 rounded-lg border-l-4 <?php echo $bgClass; ?> transition-all">
                        <div class="flex items-center justify-between">
                            <span class="font-medium">
                                <i class="fas fa-database text-sm mr-2"></i>
                                <?php echo htmlspecialchars($db); ?>
                            </span>
                            <?php if ($isActive): ?>
                                <i class="fas fa-check text-blue-600"></i>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if ($selectedDatabase && $tables): ?>
            <div class="mt-6">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-sm font-semibold text-gray-700 uppercase">Tables</h2>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full"><?php echo count($tables); ?></span>
                </div>
                <div class="space-y-1">
                    <?php foreach ($tables as $tbl): ?>
                        <?php 
                        $isActive = $tbl === $selectedTable;
                        $bgClass = $isActive ? 'bg-green-50 border-green-500 text-green-700' : 'hover:bg-gray-50 border-transparent text-gray-700';
                        ?>
                        <a href="?database=<?php echo urlencode($selectedDatabase); ?>&table=<?php echo urlencode($tbl); ?>" 
                           class="block px-3 py-2 rounded-lg border-l-4 <?php echo $bgClass; ?> transition-all">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-sm">
                                    <i class="fas fa-table text-xs mr-2"></i>
                                    <?php echo htmlspecialchars($tbl); ?>
                                </span>
                                <?php if ($isActive): ?>
                                    <i class="fas fa-check text-green-600"></i>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <div class="p-4 border-t border-gray-200 bg-gray-50">
        <div class="text-xs text-gray-500 space-y-1">
            <div class="flex items-center gap-2">
                <i class="fas fa-server"></i>
                <span>Server: <?php echo htmlspecialchars(DB_HOST); ?></span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-user"></i>
                <span>User: <?php echo htmlspecialchars(DB_USER); ?></span>
            </div>
        </div>
    </div>
</div>
