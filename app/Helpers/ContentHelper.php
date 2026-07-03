<?php

namespace App\Helpers;

class ContentHelper
{
    private static ?array $cache = null;

    // Haal een tekstveld op, met een standaardwaarde als fallback
    public static function get(string $key, string $default = ''): string
    {
        $data = self::load();
        return $data[$key] ?? $default;
    }

    public static function load(): array
    {
        if (self::$cache !== null) return self::$cache;
        $path = storage_path('app/content.json');
        self::$cache = file_exists($path)
            ? (json_decode(file_get_contents($path), true) ?? [])
            : [];
        return self::$cache;
    }

    public static function save(array $data): void
    {
        file_put_contents(
            storage_path('app/content.json'),
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
        self::$cache = null;
    }
}
