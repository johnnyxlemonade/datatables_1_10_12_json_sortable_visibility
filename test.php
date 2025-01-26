<?php
session_start(); // Start session pro uchování dat

// Kontrola parametru pro přegenerování dat
if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    unset($_SESSION['userData']); // Smazání aktuálních dat ze session
}

// Pokud nejsou data v session, vygenerujeme je
if (!isset($_SESSION['userData'])) {
    function generateRandomUser($id) {
        $firstNames = ['Jan', 'Petr', 'Eva', 'Anna', 'Karel', 'Tomáš', 'Lucie', 'Marek', 'Jana', 'Veronika'];
        $lastNames = ['Novák', 'Svoboda', 'Černá', 'Bílá', 'Dvořák', 'Král', 'Pokorný', 'Zelená', 'Procházka', 'Veselý'];

        $name = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
        $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';
        $age = rand(18, 60);

        return [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'age' => $age,
        ];
    }

    // Vygenerujeme 50000 uživatelů a uložíme je do session
    $totalRecords = 50000;
    $userData = [];
    for ($i = 1; $i <= $totalRecords; $i++) {
        $userData[] = generateRandomUser($i);
    }
    $_SESSION['userData'] = $userData;
} else {
    $userData = $_SESSION['userData'];
}

// Získání parametrů od DataTables
$search = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$length = isset($_GET['length']) ? intval($_GET['length']) : 10;

// Filtrování dat podle hledaného výrazu
if (!empty($search)) {
    $filteredData = array_filter($userData, function ($row) use ($search) {
        return stripos($row['name'], $search) !== false || // Filtrování podle jména
            stripos($row['email'], $search) !== false || // Filtrování podle emailu
            stripos((string)$row['age'], $search) !== false; // Filtrování podle věku
    });
} else {
    $filteredData = $userData;
}

// Celkový počet záznamů po filtrování
$totalFiltered = count($filteredData);

// Stránkování
$pagedData = array_slice($filteredData, $start, $length);

// Odpověď pro DataTables
echo json_encode([
    "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 0,
    "recordsTotal" => count($userData), // Celkový počet záznamů bez filtrování
    "recordsFiltered" => $totalFiltered, // Celkový počet po filtrování
    "data" => $pagedData, // Záznamy pro aktuální stránku
]);
