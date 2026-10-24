<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__
    ])
    ->withSkip([
        // Folder Assets & Non-PHP
        __DIR__ . '/css',
        __DIR__ . '/js',
        __DIR__ . '/image',
        __DIR__ . '/gambar',
        __DIR__ . '/database',
        __DIR__ . '/fontawesome',
        __DIR__ . '/fontawesome6',
        __DIR__ . '/icon-menubar',
        __DIR__ . '/maintenance_image',
        __DIR__ . '/log',
        __DIR__ . '/read-more',

        // Library Pihak Ketiga (Wajib Skip)
        __DIR__ . '/radiographer/phpqrcode',
        __DIR__ . '/radiographer/vendor',
        __DIR__ . '/radiology/ckeditor',
        __DIR__ . '/radiology/fontawesome',
        // (pdf di versi terbaru ada file yang harus dicek)
        __DIR__ . '/radiology/pdf',
        __DIR__ . '/radiology/phpmailer',
        __DIR__ . '/radiology/phpqrcode',
        __DIR__ . '/radiology/sign_src',

        // File Temp & Tools
        __DIR__ . '/radiographer/files',
        __DIR__ . '/radiographer/dcm_temp',
        __DIR__ . '/phpstan.phar',
        __DIR__ . '/rector.php',
    ])
    ->withPhpSets(php83: true);
