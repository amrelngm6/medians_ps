<?php
/**
 * Database Designer Handler
 * Handles AJAX requests for the database designer
 */

session_start();
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../includes/DatabaseDesigner.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

try {
    $db = Database::getInstance();
    $designer = new DatabaseDesigner($db->getConnection());
    
    switch ($_POST['action']) {
        case 'get_schema':
            $database = $_POST['database'] ?? '';
            
            if (!$database) {
                throw new Exception('Database not specified');
            }
            
            $schema = $designer->getDatabaseSchema($database);
            $positions = $designer->getTablePositions($database);
            
            echo json_encode([
                'success' => true,
                'schema' => $schema,
                'positions' => $positions
            ]);
            break;
            
        case 'save_position':
            $database = $_POST['database'] ?? '';
            $table = $_POST['table'] ?? '';
            $x = $_POST['x'] ?? 0;
            $y = $_POST['y'] ?? 0;
            
            if (!$database || !$table) {
                throw new Exception('Missing required fields');
            }
            
            $designer->saveTablePosition($database, $table, $x, $y);
            
            echo json_encode([
                'success' => true,
                'message' => 'Position saved'
            ]);
            break;
            
        case 'create_table':
            $database = $_POST['database'] ?? '';
            $tableName = $_POST['table_name'] ?? '';
            $columns = json_decode($_POST['columns'] ?? '[]', true);
            $comment = $_POST['comment'] ?? '';
            
            if (!$database || !$tableName || empty($columns)) {
                throw new Exception('Missing required fields');
            }
            
            $designer->createTable($database, $tableName, $columns, $comment);
            
            echo json_encode([
                'success' => true,
                'message' => 'Table created successfully'
            ]);
            break;
            
        case 'add_column':
            $database = $_POST['database'] ?? '';
            $table = $_POST['table'] ?? '';
            $columnName = $_POST['column_name'] ?? '';
            $columnType = $_POST['column_type'] ?? '';
            $nullable = isset($_POST['nullable']) ? (bool)$_POST['nullable'] : true;
            $defaultValue = $_POST['default_value'] ?? null;
            $after = $_POST['after'] ?? null;
            
            if (!$database || !$table || !$columnName || !$columnType) {
                throw new Exception('Missing required fields');
            }
            
            $designer->addColumn($database, $table, $columnName, $columnType, $nullable, $defaultValue, $after);
            
            echo json_encode([
                'success' => true,
                'message' => 'Column added successfully'
            ]);
            break;
            
        case 'drop_column':
            $database = $_POST['database'] ?? '';
            $table = $_POST['table'] ?? '';
            $columnName = $_POST['column_name'] ?? '';
            
            if (!$database || !$table || !$columnName) {
                throw new Exception('Missing required fields');
            }
            
            $designer->dropColumn($database, $table, $columnName);
            
            echo json_encode([
                'success' => true,
                'message' => 'Column dropped successfully'
            ]);
            break;
            
        case 'add_foreign_key':
            $database = $_POST['database'] ?? '';
            $table = $_POST['table'] ?? '';
            $column = $_POST['column'] ?? '';
            $refTable = $_POST['ref_table'] ?? '';
            $refColumn = $_POST['ref_column'] ?? '';
            $onUpdate = $_POST['on_update'] ?? 'RESTRICT';
            $onDelete = $_POST['on_delete'] ?? 'RESTRICT';
            
            if (!$database || !$table || !$column || !$refTable || !$refColumn) {
                throw new Exception('Missing required fields');
            }
            
            $designer->addForeignKey($database, $table, $column, $refTable, $refColumn, $onUpdate, $onDelete);
            
            echo json_encode([
                'success' => true,
                'message' => 'Foreign key added successfully'
            ]);
            break;
            
        case 'drop_foreign_key':
            $database = $_POST['database'] ?? '';
            $table = $_POST['table'] ?? '';
            $constraintName = $_POST['constraint_name'] ?? '';
            
            if (!$database || !$table || !$constraintName) {
                throw new Exception('Missing required fields');
            }
            
            $designer->dropForeignKey($database, $table, $constraintName);
            
            echo json_encode([
                'success' => true,
                'message' => 'Foreign key dropped successfully'
            ]);
            break;
            
        case 'rename_table':
            $database = $_POST['database'] ?? '';
            $oldName = $_POST['old_name'] ?? '';
            $newName = $_POST['new_name'] ?? '';
            
            if (!$database || !$oldName || !$newName) {
                throw new Exception('Missing required fields');
            }
            
            $designer->renameTable($database, $oldName, $newName);
            
            echo json_encode([
                'success' => true,
                'message' => 'Table renamed successfully'
            ]);
            break;
            
        case 'drop_table':
            $database = $_POST['database'] ?? '';
            $table = $_POST['table'] ?? '';
            
            if (!$database || !$table) {
                throw new Exception('Missing required fields');
            }
            
            $designer->dropTable($database, $table);
            
            echo json_encode([
                'success' => true,
                'message' => 'Table dropped successfully'
            ]);
            break;
            
        case 'generate_sql':
            $database = $_POST['database'] ?? '';
            
            if (!$database) {
                throw new Exception('Database not specified');
            }
            
            $sql = $designer->generateSQL($database);
            
            echo json_encode([
                'success' => true,
                'sql' => $sql
            ]);
            break;
            
        default:
            throw new Exception('Unknown action');
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
