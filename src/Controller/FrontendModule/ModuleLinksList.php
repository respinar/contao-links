<?php

/*
 * This file is part of Contao Links Bundle.
 *
 * (c) Hamid Peywasti 2014-2024 <hamid@respinar.com>
 *
 * @license LGPL-3.0-or-later
 */

/**
 * Namespace
 */
namespace Respinar\Links\Frontend\Module;

use Respinar\Links\Model\LinksModel;
use Respinar\Links\Frontend\Module\ModuleLinks;

/**
 * Class ModuleLinksList
 *
 * Front end module "links list".
 */

class ModuleLinksList extends ModuleLinks
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

			return $objTemplate->parse();
		}

		$this->links_categories = $this->sortOutProtected(deserialize($this->links_categories));

		// No catalog categries available
		if (!is_array($this->links_categories) || empty($this->links_categories))
		{
			return '';
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		$this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyLinks'];

		$intTotal = LinksModel::countPublishedByPids($this->links_categories);


		if ($intTotal < 1)
		{
			return;
		}

		$arrOptions = array();
		if ($this->links_sortBy)
		{
			switch ($this->links_sortBy)
			{
				case 'title_asc':
					$arrOptions['order'] = "title ASC";
					break;
				case 'title_desc':
					$arrOptions['order'] = "title DESC";
					break;
				case 'date_asc':
					$arrOptions['order'] = "tstamp ASC";
					break;
				case 'date_desc':
					$arrOptions['order'] = "tstamp DESC";
					break;
				case 'custom':
					$arrOptions['order'] = "sorting ASC";
					break;
			}
		}


		$objLinks = LinksModel::findPublishedByPids($this->links_categories,null,0,0,$arrOptions);

		// No items found
		if ($objLinks !== null)
		{
			$this->Template->links = $this->parseLinks($objLinks);
		}

	}
}
