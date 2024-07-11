<?php

namespace Guave\TeamBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\Environment;
use Contao\ModuleModel;
use Contao\StringUtil;
use Guave\TeamBundle\Model\JobDescriptionModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'jobs')]
class JobDescriptionListController extends AbstractFrontendModuleController
{
    use FrontendModuleTrait, JobModuleTrait;

    private string $subTemplate = 'job_description_list';

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $jobIds = StringUtil::deserialize($model->jobDescriptions);
        $jobs = JobDescriptionModel::findPublishedById($jobIds, ['order' => 'tstamp DESC']);

        if ($jobs === null) {
            throw new PageNotFoundException('Page not found: ' . Environment::get('uri'));
        }

        $template->jobs = $this->parseRecords($jobs, $this->subTemplate, $model->jumpTo);

        return $template->getResponse();
    }
}
