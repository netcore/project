<?php

return [

    /**
     * Run migrate:refresh
     */
    'remigrate' => true,

    /**
     * Seed database
     */
    'seed_database' => true,

    /**
     * Regenerate IDE helper file
     */
    'regenerate_ide_helpers' => false,

    /**
     * Removables
     */
    'remove' => [

        /**
         * Remove laravel.log file
         */
        'logs' => true,

        /**
         * Files to remove from server
         */
        'files' => [

            // You can specify entire directory to remove
            'public/uploads',

            // Specify one file
            'public/system',

            // Specify array with files to delete in given directory
            'storage/private' => [
                'file-1.txt',
                'file-2.jpg',
            ]

        ],

    ],

    /**
     * Clear compiled files
     */
    'clear' => [

        // Clear cache
        'cache' => true,

        // Clear compiled views
        'views' => true,

        // Clear cached config
        'config' => true,

        // Clear cached routes
        'routes' => true,

    ]

];