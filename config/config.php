<?php

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
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['links']   = 'ModuleLinksList';
