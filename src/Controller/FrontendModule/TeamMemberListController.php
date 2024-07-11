<?php

namespace Guave\TeamBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\Environment;
use Contao\ModuleModel;
use Guave\TeamBundle\Model\TeamMemberModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'team')]
class TeamMemberListController extends AbstractFrontendModuleController
{
    use FrontendModuleTrait, JobModuleTrait;

    private string $subTemplate = 'team_member_list';

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $teamMembers = TeamMemberModel::findByPublished(1);

        if ($teamMembers === null) {
            throw new PageNotFoundException('Page not found: ' . Environment::get('uri'));
        }

        $template->teamMembers = $this->parseRecords($teamMembers, $this->subTemplate);

        return $template->getResponse();
    }
}
