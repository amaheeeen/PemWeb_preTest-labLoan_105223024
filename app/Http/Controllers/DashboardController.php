<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        // Ambil data untuk tampilan Dashboard
        $items = Item::with('category')->get();
        
        // Data pinjaman user yang sedang login
        $myLoans = Auth::user()->loans()
                        ->with('item.category')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('dashboard.index', compact('items', 'myLoans'));
    }

    public function borrow(Request $request, Item $item) {
        if ($item->stock < 1) return back()->with('error', 'Stok habis!');

        DB::transaction(function() use ($item) {
            $item->decrement('stock');
            Auth::user()->loans()->create([
                'item_id' => $item->id,
                'status' => 'borrowed'
            ]);
        });

        return back()->with('success', 'Berhasil meminjam ' . $item->name);
    }

    public function returnItem(Loan $loan) {
        if ($loan->status == 'returned') return back();

        DB::transaction(function() use ($loan) {
            $loan->item->increment('stock');
            $loan->update([
                'status' => 'returned',
                'return_date' => now()
            ]);
        });

        return back()->with('success', 'Barang dikembalikan.');
    }
}