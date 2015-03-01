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
 * Class ModuleLinksList
 *
 * Front end module "links list".
 */

class ModuleLinksList extends \ModuleLinks
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_links';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['links_list'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			$this->links_categories = $this->sortOutProtected(deserialize($this->links_categories));

			// No catalog categries available
			if (!is_array($this->links_categories) || empty($this->links_categories))
			{
				return '';
			}

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		$this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyLinks'];

		$intTotal = \LinksModel::countPublishedByPids($this->links_categories);

		if ($intTotal < 1)
		{
			return;
		}

		$objLinks = \LinksModel::findPublishedByPids($this->links_categories);

		// No items found
		if ($objLinks !== null)
		{
			$this->Template->links = $this->parseLinks($objLinks);
		}

	}
}
