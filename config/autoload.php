<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Links
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes

	// Models
	'Contao\LinksModel'         => 'system/modules/links/models/LinksModel.php',
	'Contao\LinksCategoryModel' => 'system/modules/links/models/LinksCategoryModel.php',

	// Modules
	'Contao\ModuleLinks'        => 'system/modules/links/modules/ModuleLinks.php',
	'Contao\ModuleLinksList'    => 'system/modules/links/modules/ModuleLinksList.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_links'       => 'system/modules/links/templates/modules',
	'mod_links_empty' => 'system/modules/links/templates/modules',
	'links_text'      => 'system/modules/links/templates/links',
	'links_image'     => 'system/modules/links/templates/links',
));
