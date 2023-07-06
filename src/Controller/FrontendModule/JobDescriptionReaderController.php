<?php

namespace Guave\TeamBundle\Controller\FrontendModule;

use Contao\Config;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\CoreBundle\Routing\ResponseContext\HtmlHeadBag\HtmlHeadBag;
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\Environment;
use Contao\Input;
use Contao\ModuleModel;
use Contao\System;
use Contao\Template;
use Guave\TeamBundle\Model\JobDescriptionModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @FrontendModule(category="jobs")
 */
class JobDescriptionReaderController extends AbstractFrontendModuleController
{
    use FrontendModuleTrait, JobModuleTrait;

    private string $subTemplate = 'job_description_reader';

    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {
        if (!isset($_GET['items']) && isset($_GET['auto_item']) && Config::get('useAutoItem')) {
            Input::setGet('items', Input::get('auto_item'));
        }

        if (!Input::get('items')) {
            return $template->getResponse();
        }

        $job = JobDescriptionModel::findByAlias(Input::get('items'));
        if ($job === null) {
            throw new PageNotFoundException('Page not found: ' . Environment::get('uri'));
        }

        $template->job = $this->parseRecord($job, $this->subTemplate);

        $responseContext = System::getContainer()
            ->get('contao.routing.response_context_accessor')
            ->getResponseContext();
        if ($responseContext && $responseContext->has(HtmlHeadBag::class)) {
            /** @var HtmlHeadBag $htmlHeadBag */
            $htmlHeadBag = $responseContext->get(HtmlHeadBag::class);
            $htmlDecoder = System::getContainer()->get('contao.string.html_decoder');

            if ($job->title) {
                $htmlHeadBag->setTitle($job->title);
            }
        }

        return $template->getResponse();
    }
}
