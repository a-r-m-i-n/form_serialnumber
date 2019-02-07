<?php

/*  | This extension is made with ❤ for TYPO3 CMS and zazudesign.
 *  | It is licensed under GNU General Public License.
 *  |
 *  | (c) 2019 Armin Vieweg <armin@v.ieweg.de>
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'EXT:form Serialnumber Finisher',
    'description' => 'Provides serialnumber finisher for EXT:form',
    'category' => 'misc',
    'version' => '1.0.0',
    'state' => 'stable',
    'author' => 'Armin Vieweg',
    'author_email' => 'armin@v.ieweg.de',
    'author_company' => 'Sponsored by: zazudesign - die Schwarzwald Werbeagentur in Berlin',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-9.5.99',
            'form' => '9.5.0-9.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'suggests' => [],
    'autoload' => [
        'psr-4' => ['T3\\FormSerialnumber\\' => 'Classes']
    ],
];
