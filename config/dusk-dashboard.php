<?php

return [
    /*
     * You may specify which host the dashboard runs on in case it differs from the APP_URL
     */
    'host' => env('DUSK_DASHBOARD_URL', env('APP_URL', 'http://localhost')),
];
