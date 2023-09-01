<?php

namespace Guave\TeamBundle\Controller\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\FilesModel;
use Contao\System;
use Contao\Template;
use Guave\TeamBundle\Model\DepartmentModel;
use Guave\TeamBundle\Model\TeamMemberModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ContentElement("team", category="team", template="content_element/team")
 */
#[AsContentElement('team', category: 'team', template: 'content_element/team')]
class TeamController extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        $scope = System::getContainer()->get('contao.routing.scope_matcher');
        if ($scope && $scope->isBackendRequest($request)) {
            $template = new BackendTemplate('be_wildcard');
            $template->title = $model->teamTitle;
            return $template->getResponse();
        }

        $teamMembers = TeamMemberModel::findMultipleByIds(unserialize($model->teamMembers), ['return' => 'Collection']);
        if ($model->teamMembers === '') {
            $teamMembers = TeamMemberModel::findAll(['return' => 'Collection']);
        }

        $members = [];
        foreach ($teamMembers->fetchAll() as $member) {
            if ($member['department']) {
                $member['department'] = DepartmentModel::findMultipleByIds(
                    unserialize($member['department'])
                )->fetchAll();
            }

            if ($member['pictures']) {
                $member['pictures'] = FilesModel::findMultipleByUuids(unserialize($member['pictures']))->fetchAll();
            }

            $members[] = $member;
        }
        $template->teamMembers = $members;
        $template->teamTitle = $model->teamTitle;

        return $template->getResponse();
    }
}
