<?php

namespace Contao;

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



			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		$intList = $this->links_category;

		//$objLinks = $this->Database->prepare("SELECT * FROM tl_links WHERE published=1 AND pid=? ORDER BY sorting")->execute($intList);

		$objLinks = \LinksModel::findPublishedByPid($this->links_category);

		// No items found
		if ($objLinks === null)
		{
			$this->Template = new \FrontendTemplate('mod_links_empty');
			$this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyLinks'];
		} else {
			$this->Template->links = $this->parseLinks($objLinks);
		}

	}
}
