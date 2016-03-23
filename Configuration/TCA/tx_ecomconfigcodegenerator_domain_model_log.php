<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl'      => [
        'title'           => "{$translate}tx_ecomconfigcodegenerator_domain_model_log",
        'label'           => 'configuration',
        'label_alt'       => 'tstamp',
        'label_alt_force' => true,
        'default_sortby'  => 'ORDER BY tstamp',
        'tstamp'          => 'tstamp',
        'dividers2tabs'   => true,
        'rootLevel'       => 1,
        'readOnly'        => true,
#		'hideTable' => TRUE,
        'searchFields'    => 'tstamp,session_id,salutation,first_name,last_name,subject,message,company,job_title,address,postal_code,city,country,state,phone,fax,email,configuration,quantity,configured_parts,pricing,ip_address,fe_user,',
        'iconfile'        => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('belog') . 'ext_icon.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'tstamp, session_id, salutation, first_name, last_name, subject, message, company, job_title, address, postal_code, city, country, state, phone, fax, email, configuration, quantity, configured_parts, pricing, ip_address, fe_user'
    ],
    'types'     => [
        '1' => ['showitem' => 'tstamp, session_id;;;;1-1-1, salutation, first_name, last_name, subject, message, company, job_title, address, postal_code, city, country, state, phone, fax, email, configuration, quantity, configured_parts, pricing, ip_address, fe_user']
    ],
    'palettes'  => [
        '1' => ['showitem' => '']
    ],
    'columns'   => [

        'tstamp'           => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.tstamp",
            'config'  => [
                'type' => 'input',
                'size' => 13,
                'max'  => 20,
                'eval' => 'datetime'
            ]
        ],
        'session_id'       => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.session_id",
            'config'  => [
                'type' => 'input',
                'size' => 41,
                'eval' => 'trim,nospace,required'
            ]
        ],
        'salutation'       => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.salutation",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'first_name'       => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.first_name",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'last_name'        => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.last_name",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'subject'          => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.subject",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'message'          => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.message",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'company'          => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.company",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'job_title'        => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.job_title",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'address'          => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.address",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'postal_code'      => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.postal_code",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'city'             => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.city",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'country'          => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.country",
            'config'  => [
                'type'           => 'select',
                'foreign_table'  => 'tx_ecomtoolbox_domain_model_region',
                'suppress_icons' => 1
            ]
        ],
        'state'            => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.state",
            'config'  => [
                'type'           => 'select',
                'foreign_table'  => 'tx_ecomtoolbox_domain_model_state',
                'suppress_icons' => 1
            ]
        ],
        'phone'            => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.phone",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'fax'              => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.fax",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'email'            => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.email",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'configuration'    => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.configuration",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,nospace,required'
            ]
        ],
        'quantity'         => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.quantity",
            'config'  => [
                'type'    => 'input',
                'size'    => 30,
                'eval'    => 'trim,int',
                'default' => '1'
            ]
        ],
        'pricing'          => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.pricing",
            'config'  => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'ip_address'       => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.ip_address",
            'config'  => [
                'type'  => 'input',
                'max'   => 15,
                'eval'  => 'trim,nospace,is_in',
                'is_in' => '0123456789.*'
            ]
        ],
        'fe_user'          => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.fe_user",
            'config'  => [
                'type'           => 'select',
                'foreign_table'  => 'fe_users',
                'items'          => [
                    ['', 0]
                ],
                'suppress_icons' => 1
            ]
        ],
        'configured_parts' => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.configured_parts",
            'config'  => [
                'type'                => 'select',
                'foreign_table'       => 'tx_ecomconfigcodegenerator_domain_model_part',
                'foreign_table_where' => 'ORDER BY tx_ecomconfigcodegenerator_domain_model_part.part_group, tx_ecomconfigcodegenerator_domain_model_part.sorting',
                'size'                => 30,
                'autoSizeMax'         => 30,
                'maxitems'            => 9999,
                'readOnly'            => 1
            ]
        ]

    ]
];
