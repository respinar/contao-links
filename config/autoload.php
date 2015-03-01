<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Links
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'links',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'links\ModuleLinksList'     => 'system/modules/links/modules/ModuleLinksList.php',
	'links\ModuleLinks'         => 'system/modules/links/modules/ModuleLinks.php',

	// Models
	'Contao\LinksCategoryModel' => 'system/modules/links/models/LinksCategoryModel.php',
	'Contao\LinksModel'         => 'system/modules/links/models/LinksModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_links'   => 'system/modules/links/templates/modules',
	'links_text'  => 'system/modules/links/templates/links',
	'links_image' => 'system/modules/links/templates/links',
));
