<?php

/**
 * Links Extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2014-2017, Respinar
 * @author     Respinar <info@respinar.com>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       https://respinar.com/
 */
 

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 1, array
(
	'links' => array
	(
		'tables' => array('tl_links_category', 'tl_links'),
		'icon'   => 'system/modules/links/assets/icon.png'
	)
));

/**
 * Register models
 */
 $GLOBALS['TL_MODELS']['tl_links']          = 'Respinar\Links\Model\LinksModel';
 $GLOBALS['TL_MODELS']['tl_links_category'] = 'Respinar\Links\Model\LinksCategoryModel';

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['links']   = 'Respinar\Links\Frontend\Module\ModuleLinksList';
