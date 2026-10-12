<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Game;
use App\Models\ServerType;
use App\Models\Product;
use App\Models\PaymentMethod;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\TransactionLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. User
        $user = User::create([
            'name' => 'Raditya User',
            'email' => 'raditya@example.com',
            'password' => bcrypt('password123'),
        ]);

        // 2. Categories
        $catMobile = Category::create(['name' => 'Mobile Games']);
        $catPC = Category::create(['name' => 'PC Games']);

        // 3. Games
        $mlbb = Game::create([
            'category_id' => $catMobile->id, 
            'title' => 'Mobile Legends: Bang Bang', 
            'slug' => 'mlbb', 
            'developer' => 'Moonton'
        ]);
        $ff = Game::create([
            'category_id' => $catMobile->id, 
            'title' => 'Free Fire', 
            'slug' => 'free-fire', 
            'developer' => 'Garena'
        ]);
        $valorant = Game::create([
            'category_id' => $catPC->id, 
            'title' => 'Valorant', 
            'slug' => 'valorant', 
            'developer' => 'Riot Games'
        ]);

        // 4. Server Types
        ServerType::create(['game_id' => $mlbb->id, 'input_type' => 'id_server']);
        ServerType::create(['game_id' => $ff->id, 'input_type' => 'id_only']);
        ServerType::create(['game_id' => $valorant->id, 'input_type' => 'id_tagline']);

        // 5. Products
        $p1 = Product::create(['game_id' => $mlbb->id, 'name' => '86 Diamonds', 'price' => 20000, 'stock' => 500]);
        $p2 = Product::create(['game_id' => $valorant->id, 'name' => '475 VP', 'price' => 50000, 'stock' => 300]);

        // 6. Payment Methods
        $qris = PaymentMethod::create(['name' => 'QRIS', 'code' => 'qris', 'fee' => 0]);
        $brimo = PaymentMethod::create(['name' => 'BRImo', 'code' => 'brimo', 'fee' => 1000]);

        // 7. Vouchers
        $voucher = Voucher::create([
            'code' => 'DISC5K', 
            'discount_amount' => 5000, 
            'expired_at' => now()->addDays(30)
        ]);

        // 8. Orders
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $brimo->id,
            'voucher_id' => $voucher->id,
            'invoice_number' => 'INV-' . time(),
            'total_amount' => 46000,
            'status' => 'completed'
        ]);

        // 9. Order Details
        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $p2->id,
            'target_user_id' => 'PlayerOne#IDN',
            'price' => $p2->price
        ]);

        // 10. Transaction Logs
        TransactionLog::create([
            'order_id' => $order->id,
            'message' => 'Transaksi berhasil diproses via BRImo.'
        ]);
    }
}