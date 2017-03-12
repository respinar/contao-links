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
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Respinar\Links',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Respinar\Links\ModuleLinksList'    => 'system/modules/links/library/Respinar/Links/FrontendModules/ModuleLinksList.php',
	'Respinar\Links\ModuleLinks'        => 'system/modules/links/library/Respinar/Links/FrontendModules/ModuleLinks.php',

	// Models
	'Respinar\Links\LinksCategoryModel' => 'system/modules/links/library/Respinar/Links/Models/LinksCategoryModel.php',
	'Respinar\Links\LinksModel'         => 'system/modules/links/library/Respinar/Links/Models/LinksModel.php',
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
