<?php

use Guave\TeamBundle\Model\DepartmentModel;
use Guave\TeamBundle\Model\JobDescriptionModel;
use Guave\TeamBundle\Model\TeamMemberModel;

$GLOBALS['TL_MODELS']['tl_department'] = DepartmentModel::class;
$GLOBALS['TL_MODELS']['tl_job_description'] = JobDescriptionModel::class;
$GLOBALS['TL_MODELS']['tl_team_member'] = TeamMemberModel::class;

$GLOBALS['BE_MOD']['content']['team_member'] = [
    'tables' => [tl_team_member::class],
];

$GLOBALS['BE_MOD']['content']['job_description'] = [
    'tables' => [tl_job_description::class],
];

$GLOBALS['BE_MOD']['content']['department'] = [
    'tables' => [tl_department::class],
];
