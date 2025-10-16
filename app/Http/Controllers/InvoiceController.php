<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::latest()->get();
        return view('invoice.index', compact('invoices'));
    }

    public function create()
    {
        $items = Item::all();
        return view('invoice.create', compact('items'));
    }

    public function store(Request $request)
{
    $request->validate([
            'customer_name' => 'required',
            'invoice_date' => 'required|date',
            'type' => 'required|in:HPJ,HPB',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);

        $year = date('Y', strtotime($request->invoice_date));

        // Cek invoice terakhir di tahun tersebut
        $lastInvoice = Invoice::whereYear('invoice_date', $year)
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = $lastInvoice
            ? ((int) explode('/', $lastInvoice->invoice_number)[0] + 1)
            : 1;

        $invoiceNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT) . '/' . $year;

        // Simpan invoice utama
        $invoice = Invoice::create([
            'customer_name' => $request->customer_name,
            'invoice_date' => $request->invoice_date,
            'type' => $request->type,
            'total' => 0,
            'invoice_number' => $invoiceNumber,
        ]);

        $total = 0;

        foreach ($request->items as $itemData) {
            $item = Item::findOrFail($itemData['item_id']);
            $price = $request->type === 'HPJ' ? $item->hpj : $item->hpb;
            $subtotal = $itemData['quantity'] * $price;
            $total += $subtotal;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_id' => $item->id,
                'quantity' => $itemData['quantity'],
                'price' => $price,
                'subtotal' => $subtotal,
            ]);
        }

        $invoice->update(['total' => $total]);

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dibuat.');
}

    public function show($id)
    {
        $invoice = Invoice::with('items.item')->findOrFail($id);
        return view('invoice.show', compact('invoice'));
    }

    public function downloadPDF($id)
    {
        $invoice = Invoice::with(['items.item'])->findOrFail($id);

        // Hitung total HPF untuk tampilan PDF (tanpa ubah database)
        $totalHpf = 0;
        if ($invoice->use_hpf) {
            foreach ($invoice->items as $invItem) {
                if (!empty($invItem->item->hpf)) {
                    $totalHpf += $invItem->item->hpf;
                }
            }
        }

        $pdf = Pdf::loadView('invoice.pdf', compact('invoice', 'totalHpf'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dihapus!');
    }

    public function edit($id)
{
    $invoice = Invoice::with('items.item')->findOrFail($id);
    $items = Item::all();
    return view('invoice.edit', compact('invoice', 'items'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'customer_name' => 'required',
        'invoice_date' => 'required|date',
        'type' => 'required|in:HPJ,HPB,HPF',
        'items.*.item_id' => 'required|exists:items,id',
        'items.*.quantity' => 'required|numeric|min:1',
    ]);

    $invoice = Invoice::findOrFail($id);
    $invoice->update([
        'customer_name' => $request->customer_name,
        'invoice_date' => $request->invoice_date,
        'type' => $request->type,
        'total' => 0,
    ]);

    // Hapus item lama
    $invoice->items()->delete();

    $total = 0;

    // Simpan item baru
    foreach ($request->items as $itemData) {
        $item = Item::findOrFail($itemData['item_id']);
        $price = match ($request->type) {
            'HPJ' => $item->hpj,
            'HPB' => $item->hpb,
            'HPF' => $item->hpf,
        };
        $subtotal = $itemData['quantity'] * $price;
        $total += $subtotal;

        $invoice->items()->create([
            'item_id' => $item->id,
            'quantity' => $itemData['quantity'],
            'price' => $price,
            'subtotal' => $subtotal,
        ]);
    }

    $invoice->update(['total' => $total]);

    return redirect()->route('invoices.index')->with('success', 'Invoice berhasil diperbarui.');
}
}
