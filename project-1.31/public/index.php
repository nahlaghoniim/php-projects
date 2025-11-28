<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require APP_PATH . 'App.php';

function getTransactionFiles(string $dir): array
{
    $files = [];

    foreach (scandir($dir) as $file) {
        if ($file === '.' || $file === '..') continue;

        $path = $dir . $file;

        if (is_file($path)) {
            $files[] = $path;
        }
    }

    return $files;
}

$transactions = [];

foreach (getTransactionFiles(FILES_PATH) as $file) {
    $transactions = array_merge(
        $transactions,
        getTransactions($file, 'extractTransaction')
    );
}

$totals = [
    'totalIncome'  => 0,
    'totalExpense' => 0,
];

foreach ($transactions as $transaction) {
    if ($transaction['amount'] > 0) {
        $totals['totalIncome'] += $transaction['amount'];
    } else {
        $totals['totalExpense'] += $transaction['amount'];
    }
}

$totals['netTotal'] = $totals['totalIncome'] + $totals['totalExpense'];

require VIEWS_PATH . 'transactions.php';
