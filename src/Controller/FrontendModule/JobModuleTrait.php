<?php

namespace Guave\TeamBundle\Controller\FrontendModule;

use Contao\FilesModel;
use Contao\FrontendTemplate;
use Contao\Model;

trait JobModuleTrait
{
    protected function parseRecord(Model $record, string $templateFile, ?int $detailPageId = null): string
    {
        $template = new FrontendTemplate($templateFile);
        $template->setData($record->row());

        if ($record->downloads) {
            $template->downloads = FilesModel::findMultipleByIds(unserialize($record->downloads))->fetchAll();
        }

        if ($record->pictures) {
            $template->pictures = FilesModel::findMultipleByIds(unserialize($record->pictures))->fetchAll();
        }

        if ($detailPageId !== null) {
            $template->jumpTo = $detailPageId;
            $template->detailPage = $this->generateLink($GLOBALS['TL_LANG']['MSC']['more'], $record, $detailPageId);
        }

        return $template->parse();
    }
}
