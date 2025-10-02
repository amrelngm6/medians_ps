// Global variables
const database = typeof window.database !== 'undefined' ? window.database : null;
const table = typeof window.table !== 'undefined' ? window.table : null;
const primaryKey = typeof window.primaryKey !== 'undefined' ? window.primaryKey : null;

/**
 * Show toast notification
 */
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast px-6 py-4 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} text-white flex items-center gap-3`;
    toast.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        <span>${message}</span>
    `;
    document.getElementById('toast-container').appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

/**
 * Delete a row
 */
function deleteRow(primaryValue) {
    if (!confirm('Are you sure you want to delete this row?')) return;
    
    fetch('handlers/ajax_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'delete_row',
            database: database,
            table: table,
            primary_key: primaryKey,
            primary_value: primaryValue
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`tr[data-row-id="${primaryValue}"]`).remove();
            showToast('Row deleted successfully');
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(err => showToast('Error deleting row', 'error'));
}

/**
 * Refresh table
 */
function refreshTable() {
    location.reload();
}

/**
 * Export Modal Functions
 */
function openExportModal() {
    document.getElementById('exportModal').classList.remove('hidden');
    document.getElementById('exportModal').classList.add('flex');
}

function closeExportModal() {
    document.getElementById('exportModal').classList.add('hidden');
    document.getElementById('exportModal').classList.remove('flex');
}

function exportSQL() {
    const scope = document.querySelector('input[name="sql_scope"]:checked')?.value || 'database';
    const type = document.querySelector('input[name="sql_type"]:checked')?.value || 'complete';
    
    let url = `handlers/export_handler.php?action=sql&database=${encodeURIComponent(database)}&type=${type}`;
    
    if (scope === 'table' && table) {
        url += `&table=${encodeURIComponent(table)}`;
    }
    
    window.location.href = url;
    closeExportModal();
    showToast('Export started, download will begin shortly...');
}

function exportLaravelMigration() {
    const scope = document.querySelector('input[name="laravel_scope"]:checked')?.value || 'database';
    
    let url = `handlers/export_handler.php?action=laravel_migration&database=${encodeURIComponent(database)}`;
    
    if (scope === 'table' && table) {
        url += `&table=${encodeURIComponent(table)}`;
    }
    
    window.location.href = url;
    closeExportModal();
    showToast('Generating Laravel migration files...');
}

/**
 * Import Modal Functions
 */
function openImportModal() {
    document.getElementById('importModal').classList.remove('hidden');
    document.getElementById('importModal').classList.add('flex');
}

function closeImportModal() {
    document.getElementById('importModal').classList.add('hidden');
    document.getElementById('importModal').classList.remove('flex');
    document.getElementById('importFile').value = '';
    document.getElementById('importSQLContent').value = '';
    document.getElementById('selectedFileName').classList.add('hidden');
}

function handleFileSelect(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileSize = file.size / 1024 / 1024; // Convert to MB
        
        if (fileSize > 50) {
            showToast('File size exceeds 50MB limit', 'error');
            input.value = '';
            return;
        }
        
        document.getElementById('fileName').textContent = file.name;
        document.getElementById('selectedFileName').classList.remove('hidden');
        
        // Read file content
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('importSQLContent').value = e.target.result;
        };
        reader.readAsText(file);
    }
}

function clearFileSelect() {
    document.getElementById('importFile').value = '';
    document.getElementById('importSQLContent').value = '';
    document.getElementById('selectedFileName').classList.add('hidden');
}

function importSQL() {
    const sqlContent = document.getElementById('importSQLContent').value.trim();
    
    if (!sqlContent) {
        showToast('Please select a file or paste SQL content', 'error');
        return;
    }
    
    if (!database) {
        showToast('Please select a database first', 'error');
        return;
    }
    
    if (!confirm('Are you sure you want to import this SQL file? This may modify or delete existing data.')) {
        return;
    }
    
    // Show progress
    document.getElementById('importProgress').classList.remove('hidden');
    
    fetch('handlers/ajax_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'import_sql',
            database: database,
            sql_content: sqlContent
        })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('importProgress').classList.add('hidden');
        
        if (data.success) {
            showToast(data.message);
            closeImportModal();
            
            // Reload page to show updated data
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showToast(data.message, 'error');
            
            // Show detailed errors if any
            if (data.data && data.data.errors && data.data.errors.length > 0) {
                console.error('Import Errors:', data.data.errors);
                showToast(`${data.data.errors.length} errors occurred. Check console for details.`, 'error');
            }
        }
    })
    .catch(err => {
        document.getElementById('importProgress').classList.add('hidden');
        showToast('Error importing database', 'error');
        console.error(err);
    });
}

/**
 * Keyboard shortcuts
 */
document.addEventListener('keydown', (e) => {
    if (e.ctrlKey && e.key === 'q') {
        e.preventDefault();
        openQueryModal();
    }
    if (e.ctrlKey && e.key === 'e') {
        e.preventDefault();
        openExportModal();
    }
    if (e.ctrlKey && e.key === 'i') {
        e.preventDefault();
        openImportModal();
    }
    if (e.key === 'Escape') {
        closeQueryModal();
        closeAlterColumnModal();
        closeExportModal();
        closeImportModal();
    }
});
