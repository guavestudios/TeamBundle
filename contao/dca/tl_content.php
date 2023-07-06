<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['team'] = '{type_legend},type;{text_legend},teamTitle,teamMembers;{expert_legend:hide},moduleSpacing;{invisible_legend},invisible,start,stop;';

$GLOBALS['TL_DCA']['tl_content']['fields']['teamTitle'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => false, 'tl_class' => 'w50'],
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['teamMembers'] = [
    'inputType' => 'select',
    'foreignKey' => 'tl_team_member.name',
    'eval' => ['chosen' => true, 'includeBlankOption' => true, 'multiple' => true, 'tl_class' => 'w100 clr'],
    'sql' => ['type' => 'string', 'default' => ''],
];
