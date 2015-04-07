<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
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
	'links\ModuleLinksList'    => 'system/modules/links/modules/ModuleLinksList.php',
	'links\ModuleLinks'        => 'system/modules/links/modules/ModuleLinks.php',

	// Models
	'links\LinksCategoryModel' => 'system/modules/links/models/LinksCategoryModel.php',
	'links\LinksModel'         => 'system/modules/links/models/LinksModel.php',
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
