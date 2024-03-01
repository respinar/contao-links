<?php

/*
 * This file is part of Contao Links Bundle.
 *
 * (c) Hamid Peywasti 2014-2024 <hamid@respinar.com>
 *
 * @license LGPL-3.0-or-later
 */

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['links']   = '{title_legend},name,headline,type;{category_legend},links_categories;{template_legend},links_sortBy,links_template,customTpl;{image_legend:hide},imgSize;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['links_categories'] = [
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['links_categories'],
	'exclude'              => true,
	'inputType'            => 'checkbox',
	'foreignKey'           => 'tl_links_category.title',
	'eval'                 => ['multiple'=>true, 'mandatory'=>true],
	'sql'				   => "blob NULL",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['links_sortBy'] = [
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['links_sortBy'],
	'default'                 => 'custom',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => ['custom','date_desc', 'date_asc','title_asc', 'title_desc'],
	'reference'               => &$GLOBALS['TL_LANG']['tl_module'],
	'eval'                    => ['tl_class'=>'w50'],
	'sql'                     => "varchar(16) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['links_template'] = [
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['links_template'],
	'exclude'              => true,
	'inputType'            => 'select',
	'options_callback'     => ['tl_module_links', 'getLinksTemplates'],
	'eval'				   => ['tl_class'=>'w50 clr'],
	'sql'				   => "varchar(64) NOT NULL default ''",
];


/**
 * Class tl_links
 */
class tl_module_links extends Backend
{
	/**
	 * Return all links templates as array
	 *
	 * @return array
	 */
	public function getLinksTemplates()
	{
		return $this->getTemplateGroup('links_');
	}
}
