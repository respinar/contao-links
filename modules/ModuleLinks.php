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

		$objTemplate->addImage = false;

		// Add an image
		if ($objLink->singleSRC != '')
		{
			$objModel = \FilesModel::findByUuid($objLink->singleSRC);

			if ($objModel === null)
			{
				if (!\Validator::isUuid($objLink->singleSRC))
				{
					$objTemplate->text = '<p class="error">'.$GLOBALS['TL_LANG']['ERR']['version2format'].'</p>';
				}
			}
			elseif (is_file(TL_ROOT . '/' . $objModel->path))
			{
				// Do not override the field now that we have a model registry (see #6303)
				$arrLink = $objLink->row();

				// Override the default image size
				if ($this->imgSize != '')
				{
					$size = deserialize($this->imgSize);

					if ($size[0] > 0 || $size[1] > 0 || is_numeric($size[2]))
					{
						$arrLink['size'] = $this->imgSize;
					}
				}

				$arrLink['singleSRC'] = $objModel->path;				
				$this->addImageToTemplate($objTemplate, $arrLink);
			}
		}		

		$objTemplate->class     = $strClass;
		$objTemplate->hrefclass = $objLink->class;
		$objTemplate->linkTitle = $objLink->linkTitle ? $objLink->linkTitle : $objLink->title;

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
