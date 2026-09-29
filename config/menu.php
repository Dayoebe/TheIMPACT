<?php

return [
    'groups' => [
        [
            'label' => 'Overview',
            'items' => [
                ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => '/admin', 'active' => 'admin.dashboard'],
                ['label' => 'View website', 'icon' => 'external', 'url' => '/', 'external' => true],
            ],
        ],
        [
            'label' => 'Website content',
            'items' => [
                ['label' => 'Home page', 'icon' => 'home', 'url' => '#'],
                ['label' => 'About THE IMPACT', 'icon' => 'about', 'url' => '#'],
                ['label' => 'Vision & mission', 'icon' => 'vision', 'url' => '#'],
                ['label' => 'Philosophy & focus areas', 'icon' => 'philosophy', 'url' => '#'],
            ],
        ],
        [
            'label' => 'Programmes & people',
            'items' => [
                ['label' => 'Programmes', 'icon' => 'programmes', 'url' => '#'],
                ['label' => 'Cohorts & registration', 'icon' => 'cohorts', 'url' => '#'],
                ['label' => 'Mentorship', 'icon' => 'mentorship', 'url' => '#'],
                ['label' => 'Leadership directory', 'icon' => 'leadership', 'url' => '#'],
            ],
        ],
        [
            'label' => 'Engagement',
            'items' => [
                ['label' => 'Enquiries', 'icon' => 'messages', 'url' => '#'],
                ['label' => 'Applications', 'icon' => 'applications', 'url' => '#'],
                ['label' => 'Media library', 'icon' => 'media', 'url' => '#'],
            ],
        ],
        [
            'label' => 'System',
            'items' => [
                ['label' => 'SEO & social sharing', 'icon' => 'seo', 'url' => '#'],
                ['label' => 'Website settings', 'icon' => 'settings', 'url' => '#'],
                ['label' => 'Users & access', 'icon' => 'users', 'url' => '/admin/users', 'active' => 'admin.users.*'],
            ],
        ],
    ],
];
