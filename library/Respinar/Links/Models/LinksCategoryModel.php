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
 * Run in a custom namespace, so the class can be replaced
 */
namespace Respinar\Links;


/**
 * Reads and writes Links categories
*/
class LinksCategoryModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_links_category';

}
