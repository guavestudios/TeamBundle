<?php

use Contao\Backend;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\DataContainer;
use Contao\Image;
use Contao\StringUtil;
use Contao\System;
use Terminal42\DcMultilingualBundle\Driver as DC_Multilingual;

$GLOBALS['TL_DCA'][tl_team_member::class] = [
    'config' => [
        'dataContainer' => DC_Multilingual::class,
        'enableVersioning' => true,
        'markAsCopy' => 'name',
        'languages' => System::getContainer()->get('contao.intl.locales')->getEnabledLocaleIds(),
        'fallbackLang' => 'de',
        'langPid' => 'langPid',
        'langColumnName' => 'language',
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'alias' => 'index',
                'pid,sorting,published' => 'index',
                'langPid,language' => 'index',
            ],
        ],
    ],
    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_SORTABLE,
            'fields' => ['name', 'published'],
            'flag' => DataContainer::SORT_INITIAL_LETTERS_ASC,
            'panelLayout' => 'filter;search,sort,limit',
        ],
        'label' => [
            'fields' => ['name', 'jobTitle', 'email', 'published'],
            'showColumns' => true,
        ],
        'global_operations' => [
            'all' => [
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ],
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'copy' => [
                'href' => 'act=copy',
                'icon' => 'copy.svg',
            ],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"',
            ],
            'toggle' => [
                'href' => 'act=toggle&amp;field=published',
                'icon' => 'visible.svg',
                'button_callback' => [tl_team_member::class, 'toggleIcon'],
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],
    'palettes' => [
        '__selector__' => ['displayEmail'],
        'default' => '{basic_legend},name,alias,department,displayEmail,jobTitle,text,pictures;{link_legend},linklist;{meta_legend},published;',
    ],
    'subpalettes' => [
        'displayEmail' => 'email'
    ],
    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'pid' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'langPid' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'language' => [
            'sql' => ['type' => 'string', 'length' => 2, 'default' => ''],
        ],
        'sorting' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'name' => [
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => DataContainer::SORT_INITIAL_LETTERS_ASC,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'mandatory' => true, 'tl_class' => 'w50 clr'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'alias' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [
                'maxlength' => 255,
                'rgxp' => 'alias',
                'unique' => true,
                'tl_class' => 'w50',
                'translatableFor' => '*',
                'isMultilingualAlias' => true,
                'generateAliasFromField' => 'name',
            ],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'department' => [
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => DataContainer::SORT_INITIAL_LETTERS_ASC,
            'inputType' => 'select',
            'foreignKey' => 'tl_department.title',
            'eval' => ['multiple' => true, 'tl_class' => 'w50 clr'],
            'sql' => ['type' => 'blob', 'notnull' => false],
        ],
        'displayEmail' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'checkbox',
            'eval' => ['submitOnChange' => 'eval', 'tl_class' => 'w50 clr'],
            'sql' => ['type' => 'string', 'length' => 1, 'default' => 0]
        ],
        'email' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'rgxp' => 'email', 'tl_class' => 'w50 clr'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'jobTitle' => [
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'flag' => DataContainer::SORT_INITIAL_LETTERS_ASC,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'tl_class' => 'w100 clr'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'text' => [
            'exclude' => true,
            'inputType' => 'textarea',
            'eval' => ['rte' => 'tinyMCE', 'tl_class' => 'w100 clr'],
            'sql' => ['type' => 'text', 'notnull' => false],
        ],
        'pictures' => [
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => [
                'filesOnly' => true,
                'fieldType' => 'checkbox',
                'multiple' => true,
                'extensions' => '%contao.image.valid_extensions%',
                'tl_class' => 'w50 clr',
            ],
            'sql' => ['type' => 'blob', 'notnull' => false],
        ],
        'linkListTitle' => [
            'excludes' => true,
            'inputType' => 'text',
            'eval' => ['mandatory' => false, 'tl_class' => 'w100 clr'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'linkList' => [
            'exclude' => true,
            'inputType' => 'multiColumnWizard',
            'eval' => [
                'tl_class' => 'w50 clr',
                'columnFields' => [
                    'linkText' => [
                        'label' => &$GLOBALS['TL_LANG']['tl_team_member']['linkList_linkText'],
                        'inputType' => 'text',
                        'eval' => ['tl_class' => 'w50'],
                    ],
                    'url' => [
                        'label' => &$GLOBALS['TL_LANG']['tl_team_member']['linkList_url'],
                        'inputType' => 'text',
                        'eval' => [
                            'mandatory' => true,
                            'rgxp' => 'url',
                            'decodeEntities' => true,
                            'maxlength' => 2048,
                            'dcaPicker' => true,
                            'tl_class' => 'w50 dcapicker wizard widget',
                        ],
                    ],
                    'target' => [
                        'label' => &$GLOBALS['TL_LANG']['tl_team_member']['linkList_target'],
                        'inputType' => 'checkbox',
                        'eval' => ['tl_class' => 'w50 m12'],
                    ],
                ],
            ],
            'sql' => ['type' => 'blob', 'notnull' => false],
        ],
        'published' => [
            'exclude' => true,
            'toggle' => true,
            'filter' => true,
            'sorting' => true,
            'flag' => DataContainer::SORT_DESC,
            'inputType' => 'checkbox',
            'sql' => ['type' => 'string', 'length' => 1, 'default' => ''],
        ],
    ],
];

class tl_team_member extends Backend
{
    public function toggleIcon($row, $href, $label, $title, $icon): string
    {
        $toggleField = 'published';

        $securityHelper = System::getContainer()->get('security.helper');
        if ($securityHelper && !$securityHelper->isGranted(
                ContaoCorePermissions::USER_CAN_EDIT_FIELD_OF_TABLE,
                self::class . '::' . $toggleField
            )) {
            return '';
        }

        $href .= '&amp;id=' . $row['id'];
        if (!$row[$toggleField]) {
            $icon = 'invisible.svg';
        }

        return '<a href="' . self::addToUrl($href)
            . '" title="' . StringUtil::specialchars($title)
            . '" onclick="Backend.getScrollOffset();return AjaxRequest.toggleField(this, true)">'
            . Image::getHtml(
                $icon,
                $label,
                'data-icon="' . Image::getPath('visible.svg')
                . '" data-icon-disabled="' . Image::getPath('invisible.svg')
                . '"data-state="' . ($row[$toggleField] ? 1 : 0) . '"'
            )
            . '</a> ';
    }
}
