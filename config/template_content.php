<?php

/**
 * Content-slots per template.
 *
 * Elk slot definieert: section (groepering), key (content.json), label
 * (admin-label), tag (html-element in de frontend), type (text|textarea),
 * default (fallback als er niets opgeslagen is) en optioneel hint.
 *
 * Voeg een template toe als sleutel om een afwijkende set slots te tonen.
 * Templates zonder eigen sleutel vallen terug op 'default'.
 */
return [

    /* ── Gedeeld door alle standaard templates ──────────────────── */
    'default' => [

        // ── Homepage ────────────────────────────────────────────
        ['section' => 'Homepage',           'key' => 'home_hero_label',         'label' => 'Label',     'hint' => 'Kleine tekst boven de titel', 'tag' => 'span', 'type' => 'text',     'default' => 'Ontdek'],
        ['section' => 'Homepage',           'key' => 'home_hero_titel',         'label' => 'Titel',     'tag' => 'h1',   'type' => 'text',     'default' => 'Lokale bedrijven snel gevonden'],
        ['section' => 'Homepage',           'key' => 'home_hero_sub',           'label' => 'Subtitel',  'tag' => 'p',    'type' => 'textarea', 'default' => 'Vind de beste bedrijven bij jou in de buurt — betrouwbaar, overzichtelijk en altijd actueel.'],

        // ── Bedrijven ───────────────────────────────────────────
        ['section' => 'Bedrijven',          'key' => 'bedrijven_hero_label',    'label' => 'Label',     'tag' => 'span', 'type' => 'text',     'default' => 'Overzicht'],
        ['section' => 'Bedrijven',          'key' => 'bedrijven_hero_titel',    'label' => 'Titel',     'tag' => 'h1',   'type' => 'text',     'default' => 'Alle bedrijven'],
        ['section' => 'Bedrijven',          'key' => 'bedrijven_hero_sub',      'label' => 'Subtitel',  'tag' => 'p',    'type' => 'textarea', 'default' => 'Zoek, filter en ontdek lokale bedrijven in jouw regio.'],

        // ── Over ons ────────────────────────────────────────────
        ['section' => 'Over ons — Hero',    'key' => 'about_hero_label',        'label' => 'Label',     'tag' => 'span', 'type' => 'text',     'default' => 'Over ons'],
        ['section' => 'Over ons — Hero',    'key' => 'about_hero_titel',        'label' => 'Titel',     'tag' => 'h1',   'type' => 'text',     'default' => 'Bedrijven snel en eenvoudig vinden'],
        ['section' => 'Over ons — Hero',    'key' => 'about_hero_sub',          'label' => 'Subtitel',  'tag' => 'p',    'type' => 'textarea', 'default' => 'SnelopZoek.net verbindt ondernemers met klanten in de buurt. Betrouwbaar, overzichtelijk en altijd actueel.'],

        ['section' => 'Over ons — Blok 1', 'key' => 'about_blok1_titel',       'label' => 'Titel',     'tag' => 'h3',   'type' => 'text',     'default' => 'Betrouwbaarheid'],
        ['section' => 'Over ons — Blok 1', 'key' => 'about_blok1_tekst',       'label' => 'Tekst',     'tag' => 'p',    'type' => 'textarea', 'default' => 'Alle bedrijven op ons platform worden zorgvuldig gecontroleerd. Je kunt erop vertrouwen dat de informatie die je hier vindt actueel en correct is. Kwaliteit staat bij ons altijd voorop.'],

        ['section' => 'Over ons — Blok 2', 'key' => 'about_blok2_titel',       'label' => 'Titel',     'tag' => 'h3',   'type' => 'text',     'default' => 'Aanbod'],
        ['section' => 'Over ons — Blok 2', 'key' => 'about_blok2_tekst',       'label' => 'Tekst',     'tag' => 'p',    'type' => 'textarea', 'default' => 'Van loodgieters tot schilders, van kappers tot aannemers — ons platform biedt een breed en divers aanbod van lokale bedrijven. Voor elke klus of vraag vind je hier de juiste professional.'],

        ['section' => 'Over ons — Blok 3', 'key' => 'about_blok3_titel',       'label' => 'Titel',     'tag' => 'h3',   'type' => 'text',     'default' => 'Zichtbaarheid'],
        ['section' => 'Over ons — Blok 3', 'key' => 'about_blok3_tekst',       'label' => 'Tekst',     'tag' => 'p',    'type' => 'textarea', 'default' => 'Wij helpen lokale ondernemers om online beter gevonden te worden. Met een profiel op SnelopZoek.net vergroot je jouw bereik en trek je nieuwe klanten aan zonder moeite.'],

        ['section' => 'Over ons — Verhaal','key' => 'about_verhaal_label',      'label' => 'Label',     'tag' => 'span', 'type' => 'text',     'default' => 'Ons verhaal'],
        ['section' => 'Over ons — Verhaal','key' => 'about_verhaal_titel',      'label' => 'Titel',     'tag' => 'h2',   'type' => 'text',     'default' => 'Lokale bedrijven verdienen een sterk podium'],
        ['section' => 'Over ons — Verhaal','key' => 'about_verhaal_tekst1',     'label' => 'Tekst 1',   'tag' => 'p',    'type' => 'textarea', 'default' => 'SnelopZoek.net is ontstaan vanuit een simpele gedachte: lokale ondernemers verdienen meer zichtbaarheid. Veel kwalitatieve bedrijven zijn moeilijk te vinden, terwijl klanten juist op zoek zijn naar betrouwbare professionals in hun buurt.'],
        ['section' => 'Over ons — Verhaal','key' => 'about_verhaal_tekst2',     'label' => 'Tekst 2',   'tag' => 'p',    'type' => 'textarea', 'default' => 'Ons platform brengt vraag en aanbod samen op een overzichtelijke manier. Of je nu een aannemer zoekt voor een verbouwing of een schilder voor je gevel — bij SnelopZoek.net vind je snel de juiste partij.'],

        ['section' => 'Over ons — CTA',    'key' => 'about_cta_titel',         'label' => 'Titel',     'tag' => 'h2',   'type' => 'text',     'default' => 'Staat jouw bedrijf er al bij?'],
        ['section' => 'Over ons — CTA',    'key' => 'about_cta_sub',           'label' => 'Subtitel',  'tag' => 'p',    'type' => 'textarea', 'default' => 'Meld je gratis aan en word gevonden door honderden potentiële klanten in jouw regio.'],

        // ── Contact ─────────────────────────────────────────────
        ['section' => 'Contact — Hero',     'key' => 'contact_hero_label',      'label' => 'Label',     'tag' => 'span', 'type' => 'text',     'default' => 'Contact'],
        ['section' => 'Contact — Hero',     'key' => 'contact_hero_titel',      'label' => 'Titel',     'tag' => 'h1',   'type' => 'text',     'default' => 'Neem contact op'],
        ['section' => 'Contact — Hero',     'key' => 'contact_hero_sub',        'label' => 'Subtitel',  'tag' => 'p',    'type' => 'textarea', 'default' => 'Heb je een vraag, opmerking of wil je jouw bedrijf aanmelden? Stuur ons een bericht.'],

        ['section' => 'Contact — Info',     'key' => 'contact_info_titel',      'label' => 'Titel',     'tag' => 'h2',   'type' => 'text',     'default' => 'Hoe kunnen we helpen?'],
        ['section' => 'Contact — Info',     'key' => 'contact_info_sub',        'label' => 'Subtitel',  'tag' => 'p',    'type' => 'textarea', 'default' => 'We reageren doorgaans binnen één werkdag op jouw bericht.'],
    ],

    /* ── Template-specifieke overrides ──────────────────────────── */
    // Voeg hier per template een array toe als die template andere secties heeft.
    // Voorbeeld: 'minimal' => [ ... alleen homepage hero ... ]
    // Alle templates hieronder zonder eigen definitie gebruiken automatisch 'default'.

];
