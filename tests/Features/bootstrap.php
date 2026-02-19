<?php declare(strict_types=1);

use Illuminate\Translation\Translator;

app(Translator::class)->addLines(
    [
        'example.array' => ['foo', 'bar'],
        'example.string' => 'Hello, World!',
    ],
    'en'
);
