<?php

namespace Guave\TeamBundle\Model;

use Contao\Model\Collection;
use Terminal42\DcMultilingualBundle\Model\Multilingual;

/**
 * @property int $id
 * @property int $pid
 * @property int $langPid
 * @property string $language
 * @property int $sorting
 * @property int $tstamp
 * @property string $name
 * @property string $alias
 * @property string $department
 * @property bool $displayEmail
 * @property string $email
 * @property string $jobTitle
 * @property string $text
 * @property string $pictures
 * @property string $linklistTitle
 * @property string $linklist
 * @property bool $published
 *
 * @method static TeamMemberModel|null findById($id, array $opt = array())
 * @method static TeamMemberModel|null findByPk($id, array $opt = array())
 * @method static TeamMemberModel|null findOneBy($col, $val, array $opt = array())
 * @method static TeamMemberModel|null findOneByPid($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByLangPid($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByLanguage($val, array $opt = array())
 * @method static TeamMemberModel|null findOneBySorting($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByTstamp($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByName($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByAlias($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByDepartment($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByDisplayEmail($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByEmail($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByJobTitle($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByText($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByPictures($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByLinklistTitle($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByLinklist($val, array $opt = array())
 * @method static TeamMemberModel|null findOneByPublished($val, array $opt = array())
 *
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByPid($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByLangPid($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByLanguage($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findBySorting($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByTstamp($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByName($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByAlias($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByDepartment($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByDisplayEmail($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByEmail($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByJobTitle($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByText($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByPictures($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByLinklistTitle($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByLinklist($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findByPublished($val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findMultipleByIds($var, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findBy($col, $val, array $opt = array())
 * @method static Collection|TeamMemberModel[]|TeamMemberModel|null findAll(array $opt = array())
 *
 * @method static integer countById($id, array $opt = array())
 * @method static integer countByPid($val, array $opt = array())
 * @method static integer countByLangPid($val, array $opt = array())
 * @method static integer countByLanguage($val, array $opt = array())
 * @method static integer countBySorting($val, array $opt = array())
 * @method static integer countByTstamp($val, array $opt = array())
 * @method static integer countByName($val, array $opt = array())
 * @method static integer countByAlias($val, array $opt = array())
 * @method static integer countByDepartment($val, array $opt = array())
 * @method static integer countByDisplayEmail($val, array $opt = array())
 * @method static integer countByEmail($val, array $opt = array())
 * @method static integer countByJobTitle($val, array $opt = array())
 * @method static integer countByText($val, array $opt = array())
 * @method static integer countByPictures($val, array $opt = array())
 * @method static integer countByLinklistTitle($val, array $opt = array())
 * @method static integer countByLinklist($val, array $opt = array())
 * @method static integer countByPublished($val, array $opt = array())
 */
class TeamMemberModel extends Multilingual
{
    protected static $strTable = 'tl_team_member';
}
