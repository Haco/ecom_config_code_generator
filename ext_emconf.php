<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "ecom_config_code_generator"
 *
 * Auto generated by Extension Builder 2015-09-14
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[ 'ecom_config_code_generator' ] = [
    'title'            => 'Config code generator',
    'description'      => 'Configuration code generator',
    'category'         => 'plugin',
    'author'           => 'Sebastian Iffland, Nicolas Scheidler',
    'author_email'     => 'Nicolas.Scheidler@ecom-ex.com',
    'state'            => 'stable',
    'internal'         => '',
    'uploadfolder'     => '1',
    'createDirs'       => '',
    'clearCacheOnLoad' => 0,
    'version'          => '1.3.6',
    'constraints'      => [
        'depends'   => [
            'core'               => '6.2-7.6.99',
            'php'                => '5.5-7.0.6',
            'ecom_toolbox'       => '2.0.5',
            'ecom_product_tools' => '7.6.8',
            'powermail'          => ''
        ],
        'conflicts' => [
        ],
        'suggests'  => [
        ],
    ],
];