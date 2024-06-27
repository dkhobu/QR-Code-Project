<?php
session_start();
include('connection/connect.php');

$message = '';

// Function to check if a feature should be shown based on admin preferences
function showFeature($feature, $adminPreferences) {
    return isset($adminPreferences[$feature]) && $adminPreferences[$feature] == true;
}

function addColumn($conn, $tableName, $newColumnName, $newColumnType) {
    $checkColumnExists = "SHOW COLUMNS FROM `$tableName` LIKE '$newColumnName'";
    $result = $conn->query($checkColumnExists);

    if ($result && $result->num_rows > 0) {
        return "Column '$newColumnName' already exists.";
    }

    $sql = "ALTER TABLE `$tableName` ADD `$newColumnName` $newColumnType";
    if ($conn->query($sql)) {
        return "New column added successfully!";
    } else {
        return "Error adding column: " . $conn->error;
    }
}

function dropColumn($conn, $tableName, $columnToDrop) {
    $checkColumnExists = "SHOW COLUMNS FROM `$tableName` LIKE '$columnToDrop'";
    $result = $conn->query($checkColumnExists);

    if ($result && $result->num_rows > 0) {
        $sql = "ALTER TABLE `$tableName` DROP COLUMN `$columnToDrop`";
        if ($conn->query($sql)) {
            return "Column dropped successfully!";
        } else {
            return "Error dropping column: " . $conn->error;
        }
    } else {
        return "Column '$columnToDrop' does not exist.";
    }
}

function toggleVisibility($columnsToToggle) {
    $_SESSION['visibleColumns'] = $columnsToToggle;
    return "Columns visibility toggled successfully!";
}

$departments = ['aet', 'bt','cse', 'ece','it',];
$devices = ['computers', 'laptops', 'printers'];

// Dummy admin preferences (replace this with actual admin preferences from database)
$adminPreferences = [
    'show_add_column' => true,
    'show_drop_column' => true,
    'show_toggle_visibility' => true
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $department = $_POST['department'];
    $device = $_POST['device'];
    $tableName = $department . $device;

    switch ($action) {
        case 'add':
            if (isset($_POST['newColumnName']) && isset($_POST['newColumnType'])) {
                $message = addColumn($conn, $tableName, $_POST['newColumnName'], $_POST['newColumnType']);
            } else {
                $message = "Please provide both column name and type.";
            }
            break;
        
        case 'drop':
            if (isset($_POST['dropColumn'])) {
                $message = dropColumn($conn, $tableName, $_POST['dropColumn']);
            } else {
                $message = "Please select a column to drop.";
            }
            break;

        case 'toggleVisibility':
            if (isset($_POST['toggleColumns'])) {
                $message = toggleVisibility($_POST['toggleColumns']);
            } else {
                $_SESSION['visibleColumns'] = [];
                $message = "No columns selected for visibility.";
            }
            break;
    }
}

// Fetch current columns in the table
$columns = [];
if (isset($_POST['department']) && isset($_POST['device'])) {
    $department = $_POST['department'];
    $device = $_POST['device'];
    $tableName = $department . $device;

    $columnsResult = $conn->query("SHOW COLUMNS FROM `$tableName`");
    if ($columnsResult && $columnsResult->num_rows > 0) {
        while ($row = $columnsResult->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
    }
}

// Fetch visible columns from session or set default visibility
$visibleColumns = isset($_SESSION['visibleColumns']) ? $_SESSION['visibleColumns'] : $columns;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Columns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">                    
               <a class="navbar-brand" href="adminhome.php">
                    <img src="image/logo.png" alt="logo" style="width:70px" class="rounded-pill">
                </a>     
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="AdminPanel.php">Admin</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Department
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="admin/aetdept/home.php">AGRI Department</a></li>
                                <li><a class="dropdown-item" href="admin/btdept/home.php">BIOTECH Department</a></li>
                                <li><a class="dropdown-item" href="admin/csedept/home.php">CSE Department</a></li>
                                <li><a class="dropdown-item" href="admin/ecedept/home.php">ECE Department</a></li>
                                <li><a class="dropdown-item" href="admin/itdept/home.php">IT Department</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownReports" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                View Reports
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownReports">
                                <li><a class="dropdown-item" href="user/computer/view_reports.php?type=computer">Computer</a></li>
                                <li><a class="dropdown-item" href="user/laptop/view_reports.php?type=laptop">Laptop</a></li>
                                <li><a class="dropdown-item" href="user/printer/view_reports.php?type=printer">Printer</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login/login.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h3 class="mt-4 mb-3 text-center text-success">Admin Panel - Manage Columns</h3>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Select Department and Device -->
        <div class="card mb-3">
            <div class="card-header">Select Department and Device</div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?php echo $dept; ?>"><?php echo strtoupper($dept); ?></option>
                                                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="device" class="form-label">Device</label>
                    <select class="form-select" id="device" name="device" required>
                        <?php foreach ($devices as $dev): ?>
                            <option value="<?php echo $dev; ?>"><?php echo strtoupper($dev); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Select</button>
            </form>
        </div>
    </div>

    <!-- Add New Column Form -->
    <?php if (!empty($columns) && showFeature('show_add_column', $adminPreferences)): ?>
        <div class="card mb-3">
            <div class="card-header">Add New Column</div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="department" value="<?php echo $department; ?>">
                    <input type="hidden" name="device" value="<?php echo $device; ?>">
                    <div class="mb-3">
                        <label for="newColumnName" class="form-label">Column Name</label>
                        <input type="text" class="form-control" id="newColumnName" name="newColumnName" required>
                    </div>
                    <div class="mb-3">
                        <label for="newColumnType" class="form-label">Column Type</label>
                        <select class="form-select" id="newColumnType" name="newColumnType" required>
                            <option value="VARCHAR(255)">VARCHAR(255)</option>
                            <option value="INT">INT</option>
                            <option value="DATE">DATE</option>
                            <option value="TEXT">TEXT</option>
                            <!-- Add more types as needed -->
                        </select>
                    </div>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Add Column</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Drop Column Form -->
    <?php if (!empty($columns) && showFeature('show_drop_column', $adminPreferences)): ?>
        <div class="card mb-3">
            <div class="card-header">Drop Column</div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="department" value="<?php echo $department; ?>">
                    <input type="hidden" name="device" value="<?php echo $device; ?>">
                    <div class="mb-3">
                        <label for="dropColumn" class="form-label">Select Column to Drop</label>
                        <select class="form-select" id="dropColumn" name="dropColumn" required>
                            <?php foreach ($columns as $column): ?>
                                <option value="<?php echo $column; ?>"><?php echo ucwords(str_replace('_', ' ', $column)); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="action" value="drop" class="btn btn-danger">Drop Column</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Toggle Column Visibility Checkboxes -->
    <?php if (!empty($columns) && showFeature('show_toggle_visibility', $adminPreferences)): ?>
        <div class="card mb-3">
            <div class="card-header">Toggle Column Visibility</div>
            <div class="card-body">
                <form id="toggleColumnsForm" method="POST" action="">
                    <input type="hidden" name="department" value="<?php echo $department; ?>">
                    <input type="hidden" name="device" value="<?php echo $device; ?>">
                    <div class="mb-3">
                        <label class="form-label">Toggle Columns:</label><br>
                        <?php foreach ($columns as $column): ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input toggle-checkbox" type="checkbox" id="<?php echo $column; ?>" name="toggleColumns[]" value="<?php echo $column; ?>" <?php echo in_array($column, $visibleColumns) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="<?php echo $column; ?>"><?php echo ucwords(str_replace('_', ' ', $column)); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit" name="action" value="toggleVisibility" class="btn btn-primary">Toggle Visibility</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <!-- Editable Admin Preferences Form -->
    <form method="POST" action="">
        <input type="hidden" name="action" value="updatePreferences">
        <div class="mb-3">
            <label for="showAddColumn" class="form-label">Show Add Column</label>
            <select class="form-select" id="showAddColumn" name="showAddColumn">
                <option value="1" <?php echo $adminPreferences['show_add_column'] == 1 ? 'selected' : ''; ?>>Yes</option>
                <option value="0" <?php echo $adminPreferences['show_add_column'] == 0 ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="showDropColumn" class="form-label">Show Drop Column</label>
            <select class="form-select" id="showDropColumn" name="showDropColumn">
                <option value="1" <?php echo $adminPreferences['show_drop_column'] == 1 ? 'selected' : ''; ?>>Yes</option>
                <option value="0" <?php echo $adminPreferences['show_drop_column'] == 0 ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="showToggleVisibility" class="form-label">Show Toggle Visibility</label>
            <select class="form-select" id="showToggleVisibility" name="showToggleVisibility">
                <option value="1" <?php echo $adminPreferences['show_toggle_visibility'] == 1 ? 'selected' : ''; ?>>Yes</option>
                <option value="0" <?php echo $adminPreferences['show_toggle_visibility'] == 0 ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Preferences</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.12.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
