<?php

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['links']   = '{title_legend},name,headline,type;{category_legend},links_categories;{template_legend:hide},links_template,customTpl;{image_legend:hide},imgSize;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['links_categories'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['links_categories'],
	'exclude'              => true,
	'inputType'            => 'checkbox',
	'options_callback'     => array('tl_module_links', 'getCategories'),
	'eval'                 => array('multiple'=>true, 'mandatory'=>true),
	'sql'				   => "blob NULL",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['links_template'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['links_template'],
	'exclude'              => true,
	'inputType'            => 'select',
	'options_callback'     => array('tl_module_links', 'getLinksTemplates'),
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
class tl_module_links extends Backend
{

	/**
	 * Get all links archives and return them as array
	 * @return array
	 */
	public function getCategories()
	{
		//if (!$this->User->isAdmin && !is_array($this->User->news))
		//{
		//	return array();
		//}

		$arrCategories = array();
		$objCategories = $this->Database->execute("SELECT id, title FROM tl_links_category ORDER BY title");

		while ($objCategories->next())
		{
			//if ($this->User->hasAccess($objArchives->id, 'news'))
			//{
				$arrCategories[$objCategories->id] = $objCategories->title;
			//}
		}

		return $arrCategories;
	}


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
