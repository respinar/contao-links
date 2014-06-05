<?php

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['links']   = '{title_legend},name,headline,type;{category_legend},links_category;{protected_legend:hide},protected;{template_legend:hide},links_template,imgSize;;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['links_category'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['links_category'],
	'exclude'              => true,
	'inputType'            => 'radio',
	'foreignKey'           => 'tl_links_category.title',
	'eval'                 => array('multiple'=>true, 'mandatory'=>true),
	'sql'				   => "int(10) unsigned NOT NULL default '0'",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['links_template'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['links_template'],
	'exclude'              => true,
	'inputType'            => 'select',
	'options_callback'     => array('tl_links_template', 'getLinksTemplates'),
	'eval'				   => array('tl_class'=>'w50'),
	'sql'				   => "varchar(64) NOT NULL default ''",
);


/**
 * Class tl_links
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Hamid Abbaszadeh 2014
 * @author     Hamid Abbaszadeh <http://respinar.com>
 * @package    Links
 */
class tl_links_template extends Backend
{

	/**
	 * Return all links templates as array
	 * @param object
	 * @return array
	 */
	public function getLinksTemplates(DataContainer $dc)
	{
		return $this->getTemplateGroup('links_', $dc->activeRecord->pid);
	}
}
