<?php
$modules = ['AgricultureManagement', 'AutoRepairManagement', 'BerberApp', 'ClinicManagement', 'ConstructionERP', 'CRM', 'ECommerce', 'EventManagement', 'FacilityManagement', 'Finance', 'FleetManagement', 'GymManagement', 'HotelManagement', 'HumanResources', 'LegalManagement', 'PharmacyManagement', 'RealEstateCRM', 'RestaurantPOS', 'SchoolManagement', 'TravelAgency', 'WarehouseManagement'];
$output = '';

foreach ($modules as $module) {
    $dir = 'app/Models/' . $module;
    if (!is_dir($dir)) continue;
    $output .= '### ' . strtoupper($module) . " ###\n";
    $files = scandir($dir);
    foreach ($files as $file) {
        if (str_ends_with($file, '.php')) {
            $content = file_get_contents($dir . '/' . $file);
            preg_match('/protected \$table = [\'"](.+?)[\'\"]/', $content, $tableMatch);
            preg_match('/protected \$fillable = \[(.+?)\]/s', $content, $fillableMatch);

            $tableName = $tableMatch[1] ?? 'unknown';
            $fieldsStr = $fillableMatch[1] ?? '';
            $fieldsArray = preg_split('/[\',"\s\n\r]+/', $fieldsStr, -1, PREG_SPLIT_NO_EMPTY);
            $fields = implode(', ', $fieldsArray);

            $output .= '- Model: ' . substr($file, 0, -4) . "\n";
            $output .= '  Table: ' . $tableName . "\n";
            $output .= '  Fields: ' . $fields . "\n\n";
        }
    }
    $output .= "\n";
}
file_put_contents('DB_STRUCTURE.txt', $output);
echo 'DB_STRUCTURE.txt created successfully.';
