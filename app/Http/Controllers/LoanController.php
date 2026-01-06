<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Exception;

class LoanController extends Controller
{
    // 1. TAMPILKAN DASHBOARD
    public function index()
    {
        $items = Item::with('category')->get();
        
        $myLoans = Loan::with('item')
                    ->where('user_id', 1) 
                    ->where('status', 'borrowed')
                    ->get();

        return view('dashboard', compact('items', 'myLoans'));
    }

    // 2. LOGIKA PEMINJAMAN (BORROW)
    public function store(Request $request)
    {
        $request->validate(['item_id' => 'required|exists:items,id']);

        try {
            DB::transaction(function () use ($request) { // Transaksi DB
                // A. Lock baris data item agar tidak diserobot user lain
                $item = Item::where('id', $request->item_id)->lockForUpdate()->first();

                // B. Cek Stok
                if ($item->stock <= 0) {
                    throw new Exception("Stok habis! Anda kalah cepat.");
                }

                // C. Kurangi Stok
                $item->decrement('stock');

                // D. Catat Peminjaman
                Loan::create([
                    'user_id' => 1, // Hardcode User ID 1
                    'item_id' => $item->id,
                    'borrow_date' => now(),
                    'status' => 'borrowed',
                ]);
            });

            return back()->with('success', 'Barang berhasil dipinjam!');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // 3. LOGIKA PENGEMBALIAN (RETURN)
    public function returnItem($loan_id)
    {
        try {
            DB::transaction(function () use ($loan_id) {
                // A. Cari data peminjaman & Lock
                $loan = Loan::where('id', $loan_id)->lockForUpdate()->first();

                // B. Validasi
                if (!$loan || $loan->status == 'returned') {
                    throw new Exception("Data tidak valid atau sudah dikembalikan.");
                }

                // C. Update Status Loan
                $loan->update([
                    'status' => 'returned',
                    'return_date' => now()
                ]);

                // D. Kembalikan Stok Barang
                $item = Item::find($loan->item_id);
                $item->increment('stock');
            });

            return back()->with('success', 'Barang berhasil dikembalikan.');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}