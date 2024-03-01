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
				'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href' => 'act=select',
				'class' => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			]
		],
		'operations' => [
			'edit' => [
				'label' => &$GLOBALS['TL_LANG']['tl_links']['edit'],
				'href' => 'act=edit',
				'icon' => 'edit.svg'
			],
			'copy' => [
				'label' => &$GLOBALS['TL_LANG']['tl_links']['copy'],
				'href' => 'act=paste&amp;mode=copy',
				'icon' => 'copy.svg'
			],
			'cut' => [
				'label' => &$GLOBALS['TL_LANG']['tl_links']['cut'],
				'href' => 'act=paste&amp;mode=cut',
				'icon' => 'cut.svg'
			],
			'delete' => [
				'label' => &$GLOBALS['TL_LANG']['tl_links']['delete'],
				'href' => 'act=delete',
				'icon' => 'delete.svg',
				'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			],
			'toggle' => [
				'label' => &$GLOBALS['TL_LANG']['tl_links']['toggle'],
				'icon' => 'visible.svg',
				'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback' => ['tl_links', 'toggleIcon']
			],
			'show' => [
				'label' => &$GLOBALS['TL_LANG']['tl_links']['show'],
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
			'label' => &$GLOBALS['TL_LANG']['tl_links']['title'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
			'sql' => "varchar(128) NOT NULL default ''"
		],
		'url' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['url'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'fieldType' => 'radio', 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default 'http://'"
		],
		'target' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['target'],
			'exclude' => true,
			'inputType' => 'select',
			'options' => ['_blank','_top','_none'],
			'eval' => ['tl_class' => 'w50'],
			'sql' => "char(10) NOT NULL default ''"
		],
		'linkTitle' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['linkTitle'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'rel' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['rel'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'class' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['class'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'addImage' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['addImage'],
			'exclude' => true,
			'inputType' => 'checkbox',
			'eval' => ['submitOnChange' => true],
			'sql' => "char(1) NOT NULL default ''"
		],
		'singleSRC' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['singleSRC'],
			'exclude' => true,
			'inputType' => 'fileTree',
			'eval' => ['mandatory' => true,'fieldType' => 'radio', 'files' => true, 'filesOnly' => true, 'extensions' => $GLOBALS['TL_CONFIG']['validImageTypes']],
			'sql' => "binary(16) NULL"
		],
		'alt' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['alt'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'tl_class' => 'w50 clr'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'caption' => [
			'label' => &$GLOBALS['TL_LANG']['tl_content']['caption'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 255, 'allowHtml' => true, 'tl_class' => 'w50'],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'published' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['published'],
			'exclude' => true,
			'filter' => true,
			'flag' => 1,
			'inputType' => 'checkbox',
			'eval' => ['doNotCopy' => true,'submitOnChange' => true],
			'sql' => "char(1) NOT NULL default ''"
		],
		'start' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['start'],
			'exclude' => true,
			'inputType' => 'text',
			'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
			'sql' => "varchar(10) NOT NULL default ''"
		],
		'stop' => [
			'label' => &$GLOBALS['TL_LANG']['tl_links']['stop'],
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

	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_prices::published', 'alexf'))
		//{
		//	return '';
		//}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.svg';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}



	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'toggle');
		//$this->checkPermission();

		// Check permissions to publish
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_news::published', 'alexf'))
		//{
		//	$this->log('Not enough permissions to publish/unpublish news item ID "'.$intId.'"', 'tl_news toggleVisibility', TL_ERROR);
		//	$this->redirect('contao/main.php?act=error');
		//}

		$this->createInitialVersion('tl_links_category', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_links']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_links']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_links SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					 ->execute($intId);

		$this->createNewVersion('tl_links', $intId);

	}
}
