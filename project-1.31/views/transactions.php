<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>

           <tbody>
    <?php foreach ($transactions as $transaction) : ?>
        <tr>
            <td><?= htmlspecialchars($transaction['date']) ?></td>
            <td><?= htmlspecialchars($transaction['checkNumber']) ?></td>
            <td><?= htmlspecialchars($transaction['description']) ?></td>

            <td style="color: <?= $transaction['amount'] > 0 ? 'green' : 'red' ?>">
                <?= number_format($transaction['amount'], 2) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?= number_format($totals['totalIncome'], 2) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?= number_format($totals['totalExpense'], 2) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= number_format($totals['netTotal'], 2) ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
