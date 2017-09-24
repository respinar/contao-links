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
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_links'   => 'system/modules/links/templates/modules',
	'links_text'  => 'system/modules/links/templates/links',
	'links_image' => 'system/modules/links/templates/links',
));
