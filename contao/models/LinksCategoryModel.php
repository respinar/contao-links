<?php

/*
 * This file is part of Contao Links Bundle.
 *
 * (c) Hamid Peywasti 2014-2024 <hamid@respinar.com>
 *
 * @license LGPL-3.0-or-later
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Respinar\Links\Model;

use Contao\Model;

/**
 * Reads and writes Links categories
*/
class LinksCategoryModel extends Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_links_category';

}
