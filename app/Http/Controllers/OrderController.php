<?php
// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Notifications\TransactionNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik user yang sedang login.
     */
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['items.product']) 
            ->latest() 
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Method baru: Menyimpan pesanan dan kirim notifikasi email.
     * Ini dipanggil saat user klik "Checkout" atau "Bayar".
     */
    public function store(Request $request)
    {
        // Gunakan Database Transaction agar data aman
        return DB::transaction(function () use ($request) {
            
            // 1. Logika Simpan Order (Contoh simpel)
            $order = Order::create([
                'user_id' => auth()->id(),
                'invoice_number' => 'INV-' . strtoupper(str_random(8)),
                'total_amount' => $request->total_amount, // pastikan data ini dikirim dari form
                'status' => 'pending',
            ]);

            // 2. AMBIL USER ADMIN UNTUK DIKIRIM NOTIFIKASI
            // Kita ingin memberi tahu admin bahwa ada transaksi masuk
            $admin = User::where('role', 'admin')->first();

            if ($admin) {
                // KIRIM NOTIFIKASI KE MAILTRAP
                $admin->notify(new TransactionNotification($order));
            }

            // Atau jika ingin kirim ke user yang baru saja belanja:
            // auth()->user()->notify(new TransactionNotification($order));

            return redirect()->route('orders.success', $order->id)
                             ->with('success', 'Pesanan berhasil dibuat, silakan cek email!');
        });
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $order->load(['items.product', 'items.product.primaryImage']);

        return view('orders.show', compact('order'));
    }

    /**
     * Menampilkan halaman status pembayaran sukses.
     */
    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.success', compact('order'));
    }

    /**
     * Menampilkan halaman status pembayaran pending.
     */
    public function pending(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.pending', compact('order'));
    }
}