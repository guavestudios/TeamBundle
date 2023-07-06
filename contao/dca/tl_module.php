<?php

use Contao\Backend;

$GLOBALS['TL_DCA']['tl_module']['palettes']['team_member_list'] = '{title_legend},name,headline,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['job_description_list'] = '{title_legend},name,headline,type;{config_legend},jumpTo,jobDescriptionFilter,jobDescriptions,jobDescriptionReaderModule;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['job_description_reader'] = '{title_legend},name,headline,type;{config_legend},overviewPage,jobDescriptions,customLabel;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

$GLOBALS['TL_DCA']['tl_module']['fields']['jobDescriptions'] = [
    'exclude' => true,
    'inputType' => 'picker',
    'eval' => ['multiple' => true, 'tl_class' => 'w50 clr'],
    'sql' => ['type' => 'blob', 'notnull' => false],
    'relation' => ['type' => 'hasMany', 'load' => 'lazy', 'table' => 'tl_job_description'],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['jobDescriptionFilter'] = [
    'label' => ['Filter anzeigen'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12 clr'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['jobDescriptionReaderModule'] = [
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => ['tl_module_job_description', 'getReaderModules'],
    'reference' => &$GLOBALS['TL_LANG']['tl_module'],
    'eval' => ['includeBlankOption' => true, 'tl_class' => 'w50 clr'],
    'sql' => ['type' => 'integer', 'unsigned' => true, 'notnull' => true, 'default' => 0],
];

class tl_module_job_description extends Backend
{
    public function getReaderModules()
    {
        $arrModules = array();
        $objModules = $this->Database->execute(
            "SELECT m.id, m.name, t.name AS theme FROM tl_module m LEFT JOIN tl_theme t ON m.pid=t.id WHERE m.type='job_description_reader' ORDER BY t.name, m.name"
        );

        while ($objModules->next()) {
            $arrModules[$objModules->theme][$objModules->id] = $objModules->name . ' (ID ' . $objModules->id . ')';
        }

        return $arrModules;
    }
}
