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
namespace Respinar\LinksBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\Template;
use Contao\ModuleModel;
use Contao\StringUtil;
use Respinar\LinksBundle\Helper\Links;
use Respinar\Links\Model\LinksModel;
use Respinar\Links\Frontend\Module\ModuleLinks;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ModuleLinksList
 *
 * Front end module "links list".
 */
#[AsFrontendModule(category: 'links', template: 'mod_links')]
class LinksListController extends AbstractFrontendModuleController
{

	public const TYPE = 'links_list';

	protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
	{

		$template->empty = $GLOBALS['TL_LANG']['MSC']['emptyLinks'];

		$model->links_categories = StringUtil::deserialize($model->links_categories);
		$model->links_categories = Links::sortOutProtected($model->links_categories);

		// $intTotal = LinksModel::countPublishedByPids($model->links_categories);


		// if ($intTotal < 1)
		// {
		// 	return;
		// }

		$arrOptions = array();
		if ($model->links_sortBy)
		{
			switch ($model->links_sortBy)
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

		$objLinks = LinksModel::findPublishedByPids($model->links_categories,null,0,0,$arrOptions);

		// No items found
		if ($objLinks !== null)
		{
			$template->links = Links::parseLinks($objLinks, $model);
		}

		return $template->getResponse();
	}
}
