<?php

/*
 * This file is part of Contao Links Bundle.
 *
 * (c) Hamid Peywasti 2014-2024 <hamid@respinar.com>
 *
 * @license LGPL-3.0-or-later
 */ 

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['links'] = array(
		'tables' => array('tl_links_category', 'tl_links')
);

/**
 * Register models
 */
 $GLOBALS['TL_MODELS']['tl_links']          = 'Respinar\Links\Model\LinksModel';
 $GLOBALS['TL_MODELS']['tl_links_category'] = 'Respinar\Links\Model\LinksCategoryModel';

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['links']   = 'Respinar\Links\Frontend\Module\ModuleLinksList';
