<?php

use Contao\Backend;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\DataContainer;
use Contao\Image;
use Contao\StringUtil;
use Contao\System;

$GLOBALS['TL_DCA'][tl_job_description::class] = [
    'config' => [
        'dataContainer' => 'Multilingual',
        'switchToEdit' => true,
        'enableVersioning' => true,
        'markAsCopy' => 'title',
        'languages' => System::getContainer()->get('contao.intl.locales')->getEnabledLocaleIds(),
        'fallbackLang' => 'de',
        'langPid' => 'langPid',
        'langColumnName' => 'language',
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'pid,langPid,language,sorting,published' => 'index',
            ],
        ],
    ],
    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_UNSORTED,
            'fields' => ['title'],
            'flag' => DataContainer::SORT_ASC,
            'panelLayout' => 'filter;sort,search,limit',
        ],
        'label' => [
            'fields' => ['title'],
            'format' => '%s',
        ],
        'global_operations' => [
            'all' => [
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ],
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
            ],
            'copy' => [
                'href' => 'act=paste&amp;mode=copy',
                'icon' => 'copy.svg',
                'attributes' => 'onclick="Backend.getScrollOffset()"'
            ],
            'cut' => [
                'href' => 'act=paste&amp;mode=cut',
                'icon' => 'cut.svg',
                'attributes' => 'onclick="Backend.getScrollOffset()"'
            ],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"',
            ],
            'toggle' => [
                'href' => 'act=toggle&amp;field=published',
                'icon' => 'visible.svg',
                'button_callback' => [tl_job_description::class, 'toggleIcon'],
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],
    'palettes' => [
        'default' => '{basic_legend},title,alias,minPercent,maxPercent,startDate,workType,workLocation;{content_legend},shortDescription,externalLink,downloads,pictures;{meta_legend},published;',
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
        'title' => [
            'exclude' => true,
            'search' => true,
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
                'generateAliasFromField' => 'title',
            ],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'minPercent' => [
            'search' => true,
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['maxval' => 100, 'minval' => 10, 'rgxp' => 'prcnt', 'tl_class' => 'w50 clr'],
            'sql' => ['type' => 'string', 'length' => 3, 'default' => 0],
        ],
        'maxPercent' => [
            'search' => true,
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['maxval' => 100, 'minval' => 10, 'rgxp' => 'prcnt', 'tl_class' => 'w50'],
            'sql' => ['type' => 'string', 'length' => 3, 'default' => 0],
        ],
        'startDate' => [
            'search' => true,
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['datepicker' => true, 'tl_class' => 'w50 clr'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'workType' => [
            'search' => true,
            'exclude' => true,
            'inputType' => 'select',
            'options' => &$GLOBALS['TL_LANG']['tl_job_description']['workTypes'],
            'eval' => ['tl_class' => 'w50 clr'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'workLocation' => [
            'search' => true,
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'shortDescription' => [
            'exclude' => true,
            'inputType' => 'textarea',
            'eval' => ['tl_class' => 'w100 clr'],
            'sql' => ['type' => 'text', 'default' => ''],
        ],
        'externalLink' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'url',
                'decodeEntities' => true,
                'maxlength' => 2048,
                'dcaPicker' => true,
                'tl_class' => 'w50 clr',
            ],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'downloads' => [
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => [
                'filesOnly' => true,
                'fieldType' => 'checkbox',
                'multiple' => true,
                'extensions' => 'pdf',
                'tl_class' => 'w50 clr'
            ],
            'sql' => ['type' => 'blob', 'default' => '', 'notnull' => true],
        ],
        'pictures' => [
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => [
                'filesOnly' => true,
                'fieldType' => 'checkbox',
                'multiple' => true,
                'extensions' => $GLOBALS['TL_CONFIG']['validImageTypes'],
                'tl_class' => 'w50 clr'
            ],
            'sql' => ['type' => 'blob', 'default' => '', 'notnull' => true],
        ],
        'published' => [
            'exclude' => true,
            'toggle' => true,
            'filter' => true,
            'inputType' => 'checkbox',
            'sql' => ['type' => 'string', 'length' => 1, 'default' => ''],
        ],
    ],
];

class tl_job_description extends Backend
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
