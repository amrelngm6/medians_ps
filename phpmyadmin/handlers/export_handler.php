<?php
/**
 * Export Handler
 * Handles export requests for Laravel migrations and SQL files
 */

session_start();
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../includes/LaravelMigrationGenerator.php';
require_once __DIR__ . '/../includes/DatabaseExportImport.php';

// Get request parameters
$action = $_GET['action'] ?? '';
$database = $_GET['database'] ?? '';
$table = $_GET['table'] ?? '';
$type = $_GET['type'] ?? 'complete'; // complete, structure, data

if (!$database) {
    die('Database not specified');
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    switch ($action) {
        case 'laravel_migration':
            // Generate Laravel migrations
            $generator = new LaravelMigrationGenerator($conn);
            
            if ($table) {
                // Single table migration
                $migration = $generator->generateTableMigration($database, $table);
                
                // Set headers for download
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $migration['filename'] . '"');
                header('Content-Length: ' . strlen($migration['content']));
                
                echo $migration['content'];
            } else {
                // Full database migrations (as ZIP)
                $migrations = $generator->generateDatabaseMigrations($database);
                
                // Create temporary directory
                $tempDir = sys_get_temp_dir() . '/migrations_' . time();
                mkdir($tempDir);
                
                // Write migration files
                foreach ($migrations as $migration) {
                    file_put_contents($tempDir . '/' . $migration['filename'], $migration['content']);
                }
                
                // Create ZIP file
                $zipFile = sys_get_temp_dir() . '/' . $database . '_migrations.zip';
                $zip = new ZipArchive();
                
                if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                    $files = scandir($tempDir);
                    foreach ($files as $file) {
                        if ($file !== '.' && $file !== '..') {
                            $zip->addFile($tempDir . '/' . $file, $file);
                        }
                    }
                    $zip->close();
                }
                
                // Download ZIP file
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . $database . '_migrations.zip"');
                header('Content-Length: ' . filesize($zipFile));
                
                readfile($zipFile);
                
                // Clean up
                array_map('unlink', glob("$tempDir/*"));
                rmdir($tempDir);
                unlink($zipFile);
            }
            break;
            
        case 'sql':
            // Export as SQL
            $exporter = new DatabaseExportImport($conn);
            
            if ($table) {
                // Single table export
                if ($type === 'structure') {
                    $sql = $exporter->exportTableStructure($database, $table);
                    $filename = $database . '_' . $table . '_structure.sql';
                } else {
                    $sql = $exporter->exportTable($database, $table);
                    $filename = $database . '_' . $table . '.sql';
                }
            } else {
                // Full database export
                if ($type === 'structure') {
                    $sql = $exporter->exportStructure($database);
                    $filename = $database . '_structure.sql';
                } else {
                    $sql = $exporter->exportDatabase($database);
                    $filename = $database . '.sql';
                }
            }
            
            // Set headers for download
            header('Content-Type: application/sql');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . strlen($sql));
            
            echo $sql;
            break;
            
        default:
            die('Invalid action');
    }
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
