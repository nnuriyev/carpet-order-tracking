<?php

return [

    'gender' => [
        1 => 'Kişi', 
        0 => 'Qadın'
    ],

    'customerStatus' => [
        0 => 'Nəzarətdə',
        1 => 'Maraqlandı',
        2 => 'Sifariş'
    ],

    'customerType' => [
        0 => 'VIP', 
        1 => 'Standart',
        2 => 'Real',
        3 => 'Blok'
    ],

    'orderStatus' => [
        0 => 'Yeni',
        1 => 'Prosesdə',
        2 => 'Tamamlanıb',
        3 => 'Ləğv edilib'
    ],
    'paymentType'=>[
        1=>'Nağd',
        2=>'Online',
        3=>'Terminal'
    ],
    'costType'=>[
        1 => 'Taksi',
        2 => 'Su',
        3 => 'Dərzi',
        4 => 'Fotoshop',
        5 => 'Tel/İnternet',
        6 => 'Ofisdaxili',
        7 => 'Paypal',
        8 => 'Digər'
    ],


    /* 'emalatxanaya_gonder', 'eskizde_duzelish', 'eskiz_hazirdir', 
    'eskiz_tesdiq', 'toxuma_prosesi', 'emalatxanadan_cixdi', 
    'esas_ofise_catdi', 'chercive_ucun_gonderildi', 'chercive_hazirdir',
    'tehvile_hazir', 'tehvil_verildi', 'cancel' */

    'orderLevelNotifAccess' => [
        'admin' => [
            'emalatxanaya_gonder', 'toxuma_prosesi', 
            'emalatxanadan_cixdi', 'tehvil_verildi', 'cancel'
        ],
        'sales'=> [
            'eskiz_hazirdir', 'toxuma_prosesi', 
            'emalatxanadan_cixdi'
        ],
        'workshop'=>[
            'emalatxanaya_gonder', 'eskizde_duzelish', 
            'eskiz_tesdiq'
        ]
    ]

];
