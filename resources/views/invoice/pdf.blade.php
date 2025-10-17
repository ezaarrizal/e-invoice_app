<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota #{{ $invoice->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11pt;
            color: #333;
            line-height: 1.6;
        }

        .invoice-container {
            max-width: 170mm;
            margin: 0 auto;
            background: white;
        }

        /* Header */
        .invoice-header {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #000;
        }

        .company-name {
            font-size: 28pt;
            font-weight: 700;
            color: #000;
        }

        .company-info {
            font-size: 10pt;
            color: #666;
            line-height: 1.5;
        }

        /* Invoice Info */
        .invoice-title-section {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .invoice-title-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .invoice-title-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: right;
        }

        .invoice-label {
            font-size: 24pt;
            font-weight: 600;
            letter-spacing: 3px;
            color: #000;
            margin-bottom: 10px;
        }

        .invoice-meta {
            font-size: 10pt;
            color: #666;
            margin-bottom: 5px;
        }

        .invoice-meta strong {
            color: #000;
            font-weight: 600;
        }

        /* Customer Info */
        .customer-info {
            margin-bottom: 35px;
        }

        .info-label {
            font-size: 9pt;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 12pt;
            color: #000;
            font-weight: 500;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table thead {
            background-color: #9e9e9e;
            color: black;
        }

        .items-table th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 10pt;
            color: #333;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .items-table tbody tr:last-child td {
            border-bottom: 2px solid #000;
        }

        /* Summary */
        .summary-section {
            margin-left: 60%;
            width: 50%;
            margin-bottom: 40px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 10pt;
            border-bottom: 1px solid #e0e0e0;
        }

        .summary-row.total {
            border-bottom: none;
            padding-top: 15px;
            margin-top: 10px;
        }

        .summary-label { font-weight: 600; color: #666; }
        .summary-value { font-weight: 600; color: #000; text-align: right; }

        .summary-row.total .summary-label {
            font-size: 12pt;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .summary-row.total .summary-value {
            font-size: 14pt;
            font-weight: 700;
        }

        /* Signature Section */
        .signature-section {
            display: table;
            width: 100%;
            margin-top: 60px;
            page-break-inside: avoid;
        }

        .signature-box {
            display: table-cell;
            width: 50%;
            padding: 0 20px;
            text-align: center;
            vertical-align: top;
        }

        .signature-label {
            font-size: 9pt;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 100px;
            font-weight: 600;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-bottom: 8px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .signature-name {
            font-size: 10pt;
            color: #000;
            font-weight: 600;
        }

        /* Footer Note */
        .footer-note {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 9pt;
            color: #666;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-name">DEWI COLLECTION</div>
            <div class="company-info">
                Jl. Gatot Subroto V/2 Malang<br>
                Phone: +62 341 351586 / HP : 0818532052
            </div>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-title-section">
            <div class="invoice-title-left">
                <div class="info-label">Kepada Yth.</div>
                <div class="info-value">{{ $invoice->customer_name }}</div>
            </div>
            <div class="invoice-title-right">
                <div class="invoice-meta"><strong>Invoice no:</strong> {{ $invoice->invoice_number }}</div>
                <div class="invoice-meta"><strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</div>
                <div class="invoice-meta"><strong>Type:</strong> {{ $invoice->type }}</div>
            </div>
        </div>

        <!-- Customer -->
        <div class="customer-info">

        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 8%;" class="text-center">No</th>
                    <th style="width: 47%;">Nama Barang</th>
                    <th style="width: 15%;" class="text-center">Jumlah</th>
                    <th style="width: 15%;" class="text-right">Harga</th>
                    <th style="width: 15%;" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
    @php $no = 1; @endphp
    @foreach ($invoice->items as $invItem)
        <tr>
            <td class="text-center">{{ $no++ }}</td>
            <td>{{ $invItem->item->name ?? 'N/A' }}</td>
            <td class="text-center">{{ $invItem->quantity }}</td>
            <td class="text-right">Rp {{ number_format($invItem->price, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($invItem->subtotal, 0, ',', '.') }}</td>
        </tr>
    @endforeach
</tbody>

        </table>

        <!-- Summary -->
        <div class="summary-section">
            <div class="summary-row total">
                <span class="summary-label">Total</span>
                <span class="summary-value">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">

            </div>
            <div class="signature-box">
                <div class="signature-label">Hormat Kami</div>
                <div class="signature-line"></div>
                <div class="signature-name">( Fahrudin )</div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="footer-note">
            Terima Kasih atas Kepercayaan Anda — Barang yang sudah dibeli tidak dapat ditukar/dikembalikan
        </div>
    </div>
</body>
</html>
