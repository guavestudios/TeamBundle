<?php

namespace Guave\TeamBundle\Controller\FrontendModule;

use Contao\Config;
use Contao\Environment;
use Contao\Model;
use Contao\Model\Collection;
use Contao\PageModel;
use Contao\StringUtil;

trait FrontendModuleTrait
{
    protected function parseRecords(Collection $records, string $template, ?int $detailPageId = null): array
    {
        $parsedRecords = [];
        foreach ($records as $record) {
            $parsedRecords[] = $this->parseRecord($record, $template, $detailPageId);
        }
        return $parsedRecords;
    }

    protected function generateLink(string $link, Model $record, int $detailPageId): string
    {
        $articleUrl = $this->generateRecordUrl($record, $detailPageId);

        return sprintf(
            '<div class="link">
            <a href="%s" class="primary-link" title="%s">%s%s</a>',
            $articleUrl,
            StringUtil::specialchars($record->title, true),
            '<span class="primary-link__text"> ' . $link . '</span>',
            '</div>',
        );
    }

    protected function generateRecordUrl(Model $record, int $detailPageId): string
    {
        $page = PageModel::findByPk($detailPageId);
        if (!$page instanceof PageModel) {
            $detailPage = StringUtil::ampersand(Environment::get('request'));
        } else {
            $params = (Config::get('useAutoItem') ? '/' : '/items/') . ($record->alias ?: $record->id);
            $detailPage = StringUtil::ampersand($page->getFrontendUrl($params));
        }

        return $detailPage;
    }
}
