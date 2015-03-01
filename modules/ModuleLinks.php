<?php

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

		$strImage = '';
		$objImage = \FilesModel::findByPk($objLink->singleSRC);

		$size = deserialize($this->imgSize);

		// Add image
		if ($objImage !== null)
		{
			$strImage = \Image::getHtml(\Image::get($objImage->path, $size[0],$size[1],$size[2]));
		}

		$objTemplate->class     = $strClass;
		$objTemplate->title     = $objLink->title;
		$objTemplate->url       = $objLink->url;
		$objTemplate->target    = $objLink->target;
		$objTemplate->linkTitle = $objLink->linkTitle ? $objLink->linkTitle : $objLink->title;
		$objTemplate->rel       = $objLink->rel;
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
}
