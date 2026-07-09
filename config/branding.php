<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    | Pad naar het logo-bestand in de public map.
    */
    'site_name'    => 'Snel Op Zoek',
    'site_desc'    => 'Vind snel het juiste bedrijf bij u in de buurt.',
    'favicon'      => '/images/favicon.png',
    'logo'         => '/images/placeholder-logo.svg',
    'footer_logo'  => '/images/placeholder-logo.svg',
    'header_image' => '/images/bedrijfzoeken.png',

    /*
    |--------------------------------------------------------------------------
    | Kleuren
    |--------------------------------------------------------------------------
    | primary       = hoofdkleur (bijv. groene links, titels)
    | primary_hover = donkerdere tint van de hoofdkleur bij hover
    | accent        = accentkleur (bijv. rode hover-effecten, CTA-knop)
    | accent_hover  = donkerdere tint van de accentkleur bij hover
    */
    'colors' => [
        'primary'       => '#b8930a',
        'primary_hover' => '#956e06',
        'accent'        => '#b8930a',
        'accent_hover'  => '#956e06',
        'header_bg'     => '#f5f0e8',
        'header_text'   => '#1a1a1a',
        'footer_bg'     => '#f5f0e8',
        'cta_bg'        => '#1a1a1a',
        'cta_btn_bg'    => '#b8930a',
        'cta_btn_text'  => '#ffffff',
        'body_bg'       => '#ffffff',
        'body_text'     => '#1a1a1a',
        'card_bg'       => '#ffffff',
        'footer_text'   => '#8b7355',
        'hero_bg'       => '#1a1a1a',
        'hero_text'     => '#ffffff',
        'hero_sub'      => '#9ca3af',
        'topbar_bg'     => '#0f0f0f',
        'topbar_text'   => '#ffffff',
        'header_hover'  => '#b8930a',
        'muted'         => '#b0a898',
    ],

    /*
    |--------------------------------------------------------------------------
    | Fonts
    |--------------------------------------------------------------------------
    | family = CSS font-family waarde
    | google = optionele Google Fonts URL (of null om uit te schakelen)
    */
    'fonts' => [
        'family' => "'DM Sans', Arial, sans-serif",
        'google' => 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap',
    ],

    'template' => 'snel',

];
