<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            [
                'id' => Str::ulid(),
                'name' => '本店',
                'tel' => '0249990123',
                'address' => '福島県福島市泉1-1',
                'created_account_id' => 'system',
                'updated_account_id' => 'system',
            ],
            [
                'id' => Str::ulid(),
                'name' => '中山店',
                'tel' => '0229990000',
                'address' => '宮城県仙台市青葉区中山99-99',
                'created_account_id' => 'system',
                'updated_account_id' => 'system',
            ],
            [
                'id' => Str::ulid(),
                'name' => '泉中央店',
                'tel' => '0228881111',
                'address' => '宮城県仙台市青葉区泉中央1-1',
                'created_account_id' => 'system',
                'updated_account_id' => 'system',
            ],
        ]);
    }
}
