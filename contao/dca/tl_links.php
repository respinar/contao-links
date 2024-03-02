<?php

/*
 * This file is part of Contao Links Bundle.
 *
 * (c) Hamid Peywasti 2014-2024 <hamid@respinar.com>
 *
 * @license LGPL-3.0-or-later
 */

use Contao\DC_Table;
use Contao\Backend;
use Contao\System;

 /**
 * Load tl_content language file
 */
System::loadLanguageFile('tl_content');

/**
 * Table tl_links
 */
$GLOBALS['TL_DCA']['tl_links'] = [

	// Config
	'config' => [
		'dataContainer' => DC_Table::class,
		'ptable' => 'tl_links_category',
		'enableVersioning' => true,
		'sql' => [
			'keys' => [
				'id' => 'primary',
				'pid' => 'index'
			]
		]
	],

	// List
	'list' => [
		'sorting' => [
			'mode' => 4,
			'fields' => ['sorting'],
			'headerFields' => ['title'],
			'panelLayout' => 'search,limit',
			'child_record_callback' => ['tl_links', 'generateLinkRow']
		],
		'global_operations' => [
			'all' => [
				'href' => 'act=select',
				'class' => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			]
		],
		'operations' => [
			'edit' => [
				'href' => 'act=edit',
				'icon' => 'edit.svg'
			],
			'copy' => [
				'href' => 'act=paste&amp;mode=copy',
				'icon' => 'copy.svg'
			],
			'cut' => [
				'href' => 'act=paste&amp;mode=cut',
				'icon' => 'cut.svg'
			],
			'delete' => [
				'href' => 'act=delete',
				'icon' => 'delete.svg',
				'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"'
			],
			'toggle' => [
				'icon' => 'visible.svg',
				'href' => 'act=toggle&amp;field=published',
			],
			'show' => [
				'href' => 'act=show',
				'icon' => 'show.svg'
			]
		]
	],

	// Palettes
	'palettes' => [
		'__selector__' => ['addImage','published'],
		'default' => '{title_legend},title,url;{href_legend},linkTitle,target,class,rel;{image_legend},addImage;{publish_legend},published'
	],

	// Subpalettes
	'subpalettes' => [
		'addImage' => 'singleSRC,alt,caption',
		'published' => 'start,stop'
	],

	// Fields
	'fields' => [
		'id' => [
			'sql' => "int(10) unsigned NOT NULL auto_increment"
		],
		'pid' => [
			'foreignKey' => 'tl_links_category.title',
			'sql' => "int(10) unsigned NOT NULL default '0'",
			'relation' => ['type' => 'belongsTo', 'load' => 'eager']
		],
		'sorting' => [
			'sql' => "int(10) unsigned NOT NULL default '0'"
		],
		'tstamp' => [
			'sql' => "int(10) unsigned NOT NULL default '0'"
		],
		'title' => [
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
			'sql' => "varchar(128) NOT NULL default ''"
		],
		'url' => [
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'fieldType' => 'radio', 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default 'http://'"
		],
		'target' => [
			'exclude' => true,
			'inputType' => 'select',
			'options' => ['_blank','_top','_none'],
			'eval' => ['tl_class' => 'w50'],
			'sql' => "char(10) NOT NULL default ''"
		],
		'linkTitle' => [
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'rel' => [
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'class' => [
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'addImage' => [
			'exclude' => true,
			'inputType' => 'checkbox',
			'eval' => ['submitOnChange' => true],
			'sql' => "char(1) NOT NULL default ''"
		],
		'singleSRC' => [
			'exclude' => true,
			'inputType' => 'fileTree',
			'eval' => ['mandatory' => true,'fieldType' => 'radio', 'files' => true, 'filesOnly' => true, 'extensions' => $GLOBALS['TL_CONFIG']['validImageTypes']],
			'sql' => "binary(16) NULL"
		],
		'alt' => [
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50 clr'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'caption' => [
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'allowHtml' => true, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'published' => [
			'exclude' => true,
			'filter' => true,
			'toggle' => true,
			'flag' => 1,
			'inputType' => 'checkbox',
			'eval' => ['doNotCopy' => true,'submitOnChange' => true],
			'sql' => "char(1) NOT NULL default ''"
		],
		'start' => [
			'exclude' => true,
			'inputType' => 'text',
			'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
			'sql' => "varchar(10) NOT NULL default ''"
		],
		'stop' => [
			'exclude' => true,
			'inputType' => 'text',
			'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
			'sql' => "varchar(10) NOT NULL default ''"
		]
	]
];


/**
 * Provide miscellaneous methods that are used by the data configuration array
 */
class tl_links extends Backend
{

	/**
	 * Generate a song row and return it as HTML string
	 * @param array
	 * @return string
	 */
	public function generateLinkRow($arrRow)
	{
		return '<div>'.$arrRow['title'] . ' <span style="padding-left:3px;color:#b3b3b3;">[' . $arrRow['url'] . ']</span></div>';
	}
}
