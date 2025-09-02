<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder; use App\Models\ServiceItem; use App\Models\User; use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder{
    public function run(): void{
        User::factory()->create(['name'=>'Admin Demo','email'=>'admin@local','password'=>Hash::make('password')]);
        $items = [ ['name'=>'Buffet','unit_price'=>120.00,'unit'=>'convidado','description'=>'Buffet completo'], ['name'=>'DJ','unit_price'=>1500,'unit'=>'evento'], ['name'=>'Fotografia','unit_price'=>2000,'unit'=>'evento'] ];
        foreach($items as $i) ServiceItem::firstOrCreate(['name'=>$i['name']], $i);
    }
}
