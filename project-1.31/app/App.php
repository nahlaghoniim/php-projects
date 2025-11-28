<?php

declare(strict_types = 1);

function extractTransaction(array $transaction): array
{
    return [
        'date'        => formatDate($transaction[0]),
        'checkNumber' => $transaction[1],
        'description' => $transaction[2],
        'amount'      => (float) str_replace([',', '$'], '', $transaction[3]),
    ];
}

function getTransactions(string $fileName, ?callable $transactionHandler = null): array
{
    if (! file_exists($fileName)) {
        trigger_error('File "' . $fileName . '" does not exist.', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');

    fgetcsv($file); // skip header

    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {
        if ($transactionHandler !== null) {
            $transaction = $transactionHandler($transaction);
        }
        $transactions[] = $transaction;
    }

    fclose($file);

    return $transactions;
}

function formatDate(string $date): string
{
    return date("M j, Y", strtotime($date));
}
