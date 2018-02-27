<?php

use Illuminate\Database\Seeder;

class CreateOrderLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_levels')->insert([
            [
                'name' => 'Emalatxanaya göndər',
                'key' => 'emalatxanaya_gonder'
            ],
            [
                'name' => 'Eskizde duzeliş',
                'key' => 'eskizde_duzelish'
            ],
            [
                'name' => 'Eskiz hazırdır',
                'key' => 'eskiz_hazirdir'
            ],
            [
                'name' => 'Eskiz təsdiq edildi.',
                'key' => 'eskiz_tesdiq'
            ],
            [
                'name' => 'Toxuma prosesi',
                'key' => 'toxuma_prosesi'
            ],
            [
                'name' => 'Emalatxanadan çıxdı',
                'key' => 'emalatxanadan_cixdi'
            ],
            [
                'name' => 'Əsas ofisə çatdı',
                'key' => 'esas_ofise_catdi'
            ],
            [
                'name' => 'Çərçivə üçün göndərildi',
                'key' => 'chercive_ucun_gonderildi'
            ],
            [
                'name' => 'Çərçivə hazırdır',
                'key' => 'chercive_hazirdir'
            ],
            [
                'name' => 'Təhvilə hazır',
                'key' => 'tehvile_hazir'
            ],
            [
                'name' => 'Təhvil verildi',
                'key' => 'tehvil_verildi'
            ],
        ]);
    }
}
