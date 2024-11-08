<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Transaksi</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .container {
            width: 300px;
            margin: auto;
            padding: 10px;
            border: 1px solid #000;
            text-align: center;
        }

        h1 {
            font-size: 16px;
            margin: 0;
            padding-bottom: 10px;
        }

        h2 {
            font-size: 14px;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        th {
            text-align: left;
            border-bottom: 1px solid #000;
        }

        .item-list {
            padding-left: 0;
            margin: 0;
            list-style-type: none;
            text-align: left;
        }

        .item-list li {
            padding: 3px 0;
            display: flex;
            justify-content: space-between;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <h1>Yupita Air Minum</h1>
        <h2>Detail Transaksi</h2>
        <table>
            <tr>
                <th>Item</th>
                <td>
                    <ul class="item-list">
                        @php
                            $items = json_decode($transaction->item_kasir, true);
                        @endphp
                        @foreach ($items as $item)
                            <li>
                                {{ $item['item'] }}
                                <span>{{ $item['jumlah'] }} x {{ number_format($item['harga'], 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Total Barang</th>
                <td>{{ $transaction->jumlah_kasir }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td class="total">{{ 'Rp. ' . number_format($transaction->total_kasir, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Pembayaran</th>
                <td>{{ 'Rp. ' . number_format($transaction->pembayaran_kasir, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Kembalian</th>
                <td>{{ 'Rp. ' . number_format($transaction->kembalian_kasir, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $transaction->user->name }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $transaction->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</td>
            </tr>
        </table>
    </div>
</body>

</html>
