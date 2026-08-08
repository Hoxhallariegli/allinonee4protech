<?php
$modules = ['AgricultureManagement', 'AutoRepairManagement', 'BerberApp', 'ClinicManagement', 'ConstructionERP', 'CRM', 'ECommerce', 'EventManagement', 'FacilityManagement', 'Finance', 'FleetManagement', 'GymManagement', 'HotelManagement', 'HumanResources', 'LegalManagement', 'PharmacyManagement', 'RealEstateCRM', 'RestaurantPOS', 'SchoolManagement', 'TravelAgency', 'WarehouseManagement'];
$output = '';

$typeMap = [
    'string' => '0',
    'text' => '1',
    'integer' => '2',
    'bigInteger' => '3',
    'boolean' => '4',
    'decimal' => '5',
    'date' => '6',
    'datetime' => '7',
    'foreignId' => '8',
    'enum' => '9'
];

foreach ($modules as $module) {
    $dir = 'app/Models/' . $module;
    if (!is_dir($dir)) continue;
    $output .= "### " . strtoupper($module) . " ###\n";
    $files = scandir($dir);
    foreach ($files as $file) {
        if (str_ends_with($file, '.php')) {
            $content = file_get_contents($dir . '/' . $file);
            preg_match('/protected \$table = [\'"](.+?)[\'\"]/', $content, $tableMatch);
            preg_match('/public static function rules.*?return \[(.+?)\]; \}/s', $content, $rulesMatch);

            $tableName = $tableMatch[1] ?? 'unknown';
            $rulesStr = $rulesMatch[1] ?? '';

            $output .= "- Model: " . substr($file, 0, -4) . "\n";
            $output .= "  Table: " . $tableName . "\n";
            $output .= "  Rules: " . trim($rulesStr) . "\n\n";
        }
    }
    $output .= "\n";
}
file_put_contents('DB_RULES.txt', $output);
echo 'DB_RULES.txt created successfully.';
