<?php

namespace Guave\TeamBundle\Controller\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\FilesModel;
use Contao\StringUtil;
use Guave\TeamBundle\Model\DepartmentModel;
use Guave\TeamBundle\Model\TeamMemberModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'team')]
class TeamController extends AbstractContentElementController
{
    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $teamMembers = TeamMemberModel::findMultipleByIds(StringUtil::deserialize($model->teamMembers), ['return' => 'Collection']);
        if ($model->teamMembers === '') {
            $teamMembers = TeamMemberModel::findAll(['return' => 'Collection']);
        }

        $members = [];
        foreach ($teamMembers->fetchAll() as $member) {
            if ($member['department']) {
                $member['department'] = DepartmentModel::findMultipleByIds(StringUtil::deserialize($member['department']))->fetchAll();
            }

            if ($member['pictures']) {
                $member['pictures'] = FilesModel::findMultipleByUuids(StringUtil::deserialize($member['pictures']))->fetchAll();
            }

            $members[] = $member;
        }
        $template->teamMembers = $members;
        $template->teamTitle = $model->teamTitle;

        return $template->getResponse();
    }
}
