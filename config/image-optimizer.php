<?php

return [
    /*
     * Image Optimizer Component Options
     */
    'component' => [
        'formats' => ['png', 'jpeg', 'webp', 'avif'],
        'default_format' => 'jpeg',
    ],

    'npx' => [
        'command' => 'export PATH=\$PATH:~/bin; npx @squoosh/cli',
    ],
];
