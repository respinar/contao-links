<?php

/*
 * This file is part of Contao Links Bundle.
 *
 * (c) Hamid Peywasti 2014-2024 <hamid@respinar.com>
 *
 * @license LGPL-3.0-or-later
 */

use Contao\DC_Table;

/**
 * Table tl_links_category
 */
$GLOBALS['TL_DCA']['tl_links_category'] = [

	// Config
	'config' => [
		'dataContainer'               => DC_Table::class,
		'ctable'                      => ['tl_links'],
		'enableVersioning'            => true,
		'sql' => [
			'keys' => [
				'id' => 'primary'
			]
		]
	],

	// List
	'list' => [
		'sorting' => [
			'mode'                    => 1,
			'fields'                  => ['title'],
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		],
		'label' => [
			'fields'                  => ['title'],
			'format'                  => '%s',
		],
		'global_operations' => [
			'all' => [
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			]
		],
		'operations' => [
			'edit' => [
				'label'               => &$GLOBALS['TL_LANG']['tl_links_category']['edit'],
				'href'                => 'table=tl_links',
				'icon'                => 'edit.gif'
			],
			'editheader' => [
				'label'               => &$GLOBALS['TL_LANG']['tl_links_category']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			],
			'copy' => [
				'label'               => &$GLOBALS['TL_LANG']['tl_links_category']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			],
			'delete' => [
				'label'               => &$GLOBALS['TL_LANG']['tl_links_category']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			],
			'show' => [
				'label'               => &$GLOBALS['TL_LANG']['tl_links_category']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			]
		]
	],

	// Palettes
	'palettes' => [
		'__selector__'                => ['protected'],
		'default'                     => '{title_legend},title;{protected_legend:hide},protected;'
	],

	// Subpalettes
	'subpalettes' => [
		'protected'                   => 'groups',
	],

	// Fields
	'fields' => [
		'id' => [
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		],
		'tstamp' => [
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		],
		'title' => [
			'label'                   => &$GLOBALS['TL_LANG']['tl_links_category']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => ['mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50'],
			'sql'                     => "varchar(128) NOT NULL default ''"
		],
		'protected' => [
			'label'                   => &$GLOBALS['TL_LANG']['tl_links_category']['protected'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['submitOnChange'=>true],
			'sql'                     => "char(1) NOT NULL default ''"
		],
		'groups' => [
			'label'                   => &$GLOBALS['TL_LANG']['tl_links_category']['groups'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => ['mandatory'=>true, 'multiple'=>true],
			'sql'                     => "blob NULL",
			'relation'                => ['type'=>'hasMany', 'load'=>'lazy']
		]
	]
];
