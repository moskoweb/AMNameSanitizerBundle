<?php
return [
    'name'        => 'Name Sanitizer',
    'description' => 'Name sanitizer for Mautic.',
    'version'     => '1.1.0',
    'author'      => 'Alan Mosko <falecom@alanmosko.com.br>',
    'routes'      => [
        'main' => [
            'am_sanitize_names' => [
                'path'       => '/name_sanitizer',
                'controller' => 'AMNameSanitizerBundle:AMNameSanitizer:sanitizeNames',
            ],
        ],
    ],
    'services'    => [
        'events'       => [
            'plugin.namesanitizer.button.subscriber' => [
                'class'     => \MauticPlugin\AMNameSanitizerBundle\EventListener\ButtonSubscriber::class,
                'arguments' => [
                    'mautic.helper.integration',
                ],
            ],
            'plugin.namesanitizer.lead.subscriber'   => [
                'class'     => \MauticPlugin\AMNameSanitizerBundle\EventListener\LeadSubscriber::class,
                'arguments' => [
                    'mautic.helper.integration',
                ],
            ],
        ],
        'integrations' => [
            'mautic.integration.AMNameSanitizer' => [
                'class' => \MauticPlugin\AMNameSanitizerBundle\Integration\AMNameSanitizerIntegration::class,
            ],
        ],
        'models'       => [
            'mautic.namesanitizer.model.model' => [
                'class' => \MauticPlugin\AMNameSanitizerBundle\Model\AMNameSanitizerModel::class,
                'alias' => 'namesanitizer.model',
            ],
        ],
        'other'        => [

        ],
    ],
    'menu'        => [

    ],
];
