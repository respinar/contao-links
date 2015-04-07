<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package   links
 * @author    Hamid Abbaszadeh
 * @license   GNU/LGPL
 * @copyright 2014
 */

/**
 * Namespace
 */
namespace links;

/**
 * Class ModuleLinks
 *
 * Front end module "links".
 */

abstract class ModuleLinks extends \Module
{

	/**
	 * Generate the module
	 */
	protected function parseLink($objLink, $strClass='', $intCount=0)
	{

		$objTemplate = new \FrontendTemplate($this->links_template);

		$objTemplate->setData($objLink->row());

		$strImage = '';
		$objImage = \FilesModel::findByPk($objLink->singleSRC);

		$size = deserialize($this->imgSize);

		// Add image
		if ($objImage !== null)
		{
			$strImage = \Image::getHtml(\Image::get($objImage->path, $size[0],$size[1],$size[2]));
		}

		$objTemplate->class     = $strClass;
		$objTemplate->linkTitle = $objLink->linkTitle ? $objLink->linkTitle : $objLink->title;
		$objTemplate->image     = $strImage;

		return $objTemplate->parse();

	}

	protected function parseLinks($objLinks)
	{
		$limit = $objLinks->count();

		if ($limit < 1)
		{
			return array();
		}

		$count = 0;
		$arrLinks = array();

		while ($objLinks->next())
		{
			$arrLinks[] = $this->parseLink($objLinks, ((++$count == 1) ? ' first' : '') . (($count == $limit) ? ' last' : '') . ((($count % 2) == 0) ? ' odd' : ' even'), $count);
		}

		return $arrLinks;
	}

	/**
	 * Sort out protected archives
	 * @param array
	 * @return array
	 */
	protected function sortOutProtected($arrCategories)
	{
		if (BE_USER_LOGGED_IN || !is_array($arrCategories) || empty($arrCategories))
		{
			return $arrCategories;
		}

		$this->import('FrontendUser', 'User');
		$objCategory = \LinksCategoryModel::findMultipleByIds($arrCategories);
		$arrCategories = array();

		if ($objCategory !== null)
		{
			while ($objCategory->next())
			{
				if ($objCategory->protected)
				{
					if (!FE_USER_LOGGED_IN)
					{
						continue;
					}

					$groups = deserialize($objCategory->groups);

					if (!is_array($groups) || empty($groups) || !count(array_intersect($groups, $this->User->groups)))
					{
						continue;
					}
				}

				$arrCategories[] = $objCategory->id;
			}
		}

		return $arrCategories;
	}
}
