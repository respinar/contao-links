<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Members
 * @link    https://respinar.com
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;


/**
 * Reads and writes Links categories
 *
 * @package   Models
 * @author    Hamid Abbaszadeh <http://respinar.com>
 * @copyright Hamid Abbaszadeh 2013-2014
 */
class LinksCategoryModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_links_category';

}
