<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            [
                'id' => Str::ulid(),
                'title' => '新店舗のお知らせ',
                'content' => '宮城県に新店舗が開店します。',
                'created_account_id' => 'system',
                'created_at' => '2024-10-01 00:00:00',
                'updated_account_id' => 'system',
                'updated_at' => '2024-10-01 00:00:00',
            ],
            [
                'id' => Str::ulid(),
                'title' => '時給に関して',
                'content' => '賃上げします。',
                'created_account_id' => 'system',
                'created_at' => '2024-10-10 00:00:00',
                'updated_account_id' => 'system',
                'updated_at' => '2024-10-10 00:00:00',
            ],
            ]);
    }
}
