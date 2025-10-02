<!-- SQL Query Modal -->
<div id="queryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-3/4 max-h-[90vh] flex flex-col">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-code text-purple-600"></i>
                Execute SQL Query
            </h3>
            <button onclick="closeQueryModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6 flex-1 overflow-auto">
            <textarea id="sqlQuery" 
                      class="w-full h-32 p-4 border border-gray-300 rounded-lg font-mono text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                      placeholder="Enter your SQL query here...">SELECT * FROM `<?php echo htmlspecialchars($selectedTable ?? ''); ?>` LIMIT 10</textarea>
            <div class="mt-4 flex gap-2">
                <button onclick="executeQuery()" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-play"></i>
                    <span>Execute</span>
                </button>
                <button onclick="clearQuery()" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Clear
                </button>
            </div>
            <div id="queryResults" class="mt-6"></div>
        </div>
    </div>
</div>

<!-- Alter Column Modal -->
<div id="alterColumnModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-1/2 max-h-[90vh] flex flex-col">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-cog text-orange-600"></i>
                Change Column Type
            </h3>
            <button onclick="closeAlterColumnModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6 flex-1 overflow-auto">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Column Name</label>
                <input type="text" id="alterColumnName" readonly 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Type</label>
                <input type="text" id="alterColumnCurrentType" readonly 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">New Type</label>
                <select id="alterColumnNewType" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Select new type...</option>
                </select>
            </div>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <div class="flex items-start gap-2">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-1"></i>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold mb-1">Warning:</p>
                        <p>Changing column type may result in data loss if the new type is incompatible with existing data. Make sure to backup your data before proceeding.</p>
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="alterColumn()" 
                        class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-check"></i>
                    <span>Change Type</span>
                </button>
                <button onclick="closeAlterColumnModal()" 
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Export Modal -->
<div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-2/3 max-h-[90vh] flex flex-col">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-download text-green-600"></i>
                Export Database
            </h3>
            <button onclick="closeExportModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6 flex-1 overflow-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- SQL Export -->
                <div class="border border-gray-200 rounded-lg p-6 hover:border-blue-500 transition-colors">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                            <i class="fas fa-database text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">SQL Export</h4>
                            <p class="text-sm text-gray-500">Export as SQL file</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="sql_scope" value="database" checked class="text-blue-600">
                            <span class="text-sm">Full Database</span>
                        </label>
                        <?php if ($selectedTable): ?>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="sql_scope" value="table" class="text-blue-600">
                            <span class="text-sm">Current Table Only</span>
                        </label>
                        <?php endif; ?>
                    </div>
                    
                    <div class="space-y-3 mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="sql_type" value="complete" checked class="text-blue-600">
                            <span class="text-sm">Structure + Data</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="sql_type" value="structure" class="text-blue-600">
                            <span class="text-sm">Structure Only</span>
                        </label>
                    </div>
                    
                    <button onclick="exportSQL()" 
                            class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-download"></i>
                        <span>Export SQL</span>
                    </button>
                </div>
                
                <!-- Laravel Migration Export -->
                <div class="border border-gray-200 rounded-lg p-6 hover:border-red-500 transition-colors">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-red-100 text-red-600 p-3 rounded-lg">
                            <i class="fab fa-laravel text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Laravel Migration</h4>
                            <p class="text-sm text-gray-500">Generate migration files</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="laravel_scope" value="database" checked class="text-red-600">
                            <span class="text-sm">Full Database (ZIP)</span>
                        </label>
                        <?php if ($selectedTable): ?>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="laravel_scope" value="table" class="text-red-600">
                            <span class="text-sm">Current Table Only</span>
                        </label>
                        <?php endif; ?>
                    </div>
                    
                    <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-4">
                        <p class="text-xs text-red-800">
                            <i class="fas fa-info-circle mr-1"></i>
                            Migration files will be compatible with Laravel 10+
                        </p>
                    </div>
                    
                    <button onclick="exportLaravelMigration()" 
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-download"></i>
                        <span>Generate Migration</span>
                    </button>
                </div>
            </div>
            
            <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <div class="flex items-start gap-2">
                    <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                    <div class="text-sm text-gray-700">
                        <p class="font-semibold mb-1">Export Information:</p>
                        <ul class="list-disc list-inside space-y-1 text-gray-600">
                            <li>SQL exports can be imported back into any MySQL database</li>
                            <li>Laravel migrations are generated based on current table structure</li>
                            <li>Full database exports may take longer for large databases</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="importModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-2/3 max-h-[90vh] flex flex-col">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-upload text-purple-600"></i>
                Import Database
            </h3>
            <button onclick="closeImportModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6 flex-1 overflow-auto">
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Upload SQL File
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-purple-500 transition-colors">
                    <input type="file" id="importFile" accept=".sql" class="hidden" onchange="handleFileSelect(this)">
                    <label for="importFile" class="cursor-pointer">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-cloud-upload-alt text-5xl"></i>
                        </div>
                        <p class="text-gray-700 font-medium mb-1">Click to select SQL file</p>
                        <p class="text-sm text-gray-500">or drag and drop</p>
                        <p class="text-xs text-gray-400 mt-2">Maximum file size: 50MB</p>
                    </label>
                </div>
                <div id="selectedFileName" class="hidden mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-file-alt text-green-600"></i>
                            <span id="fileName" class="text-sm text-gray-700"></span>
                        </div>
                        <button onclick="clearFileSelect()" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Or Paste SQL Content
                </label>
                <textarea id="importSQLContent" 
                          class="w-full h-48 p-4 border border-gray-300 rounded-lg font-mono text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                          placeholder="Paste your SQL statements here..."></textarea>
            </div>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <div class="flex items-start gap-2">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-1"></i>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold mb-1">Warning:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Make sure to backup your database before importing</li>
                            <li>Importing will execute all SQL statements in the file</li>
                            <li>Existing tables with same name may be dropped if DROP statements are present</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-2">
                <button onclick="importSQL()" 
                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-upload"></i>
                    <span>Import Database</span>
                </button>
                <button onclick="closeImportModal()" 
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
            </div>
            
            <div id="importProgress" class="hidden mt-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-spinner fa-spin text-blue-600"></i>
                        <span class="text-blue-800">Importing database...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
