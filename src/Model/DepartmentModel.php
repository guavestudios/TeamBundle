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
 * @property string $title
 * @property string $alias
 * @property bool $published
 *
 * @method static DepartmentModel|null findById($id, array $opt = array())
 * @method static DepartmentModel|null findByPk($id, array $opt = array())
 * @method static DepartmentModel|null findOneBy($col, $val, array $opt = array())
 * @method static DepartmentModel|null findOneByPid($val, array $opt = array())
 * @method static DepartmentModel|null findOneByLangPid($val, array $opt = array())
 * @method static DepartmentModel|null findOneByLanguage($val, array $opt = array())
 * @method static DepartmentModel|null findOneBySorting($val, array $opt = array())
 * @method static DepartmentModel|null findOneByTstamp($val, array $opt = array())
 * @method static DepartmentModel|null findOneByTitle($val, array $opt = array())
 * @method static DepartmentModel|null findOneByAlias($val, array $opt = array())
 * @method static DepartmentModel|null findOneByPublished($val, array $opt = array())
 *
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findByPid($val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findByLangPid($val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findByLanguage($val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findBySorting($val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findByTstamp($val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findByTitle($val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findByAlias($val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findByPublished($val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findMultipleByIds($var, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findBy($col, $val, array $opt = array())
 * @method static Collection|DepartmentModel[]|DepartmentModel|null findAll(array $opt = array())
 *
 * @method static integer countById($id, array $opt = array())
 * @method static integer countByPid($val, array $opt = array())
 * @method static integer countByLangPid($val, array $opt = array())
 * @method static integer countByLanguage($val, array $opt = array())
 * @method static integer countBySorting($val, array $opt = array())
 * @method static integer countByTstamp($val, array $opt = array())
 * @method static integer countByTitle($val, array $opt = array())
 * @method static integer countByAlias($val, array $opt = array())
 * @method static integer countByPublished($val, array $opt = array())
 */
class DepartmentModel extends Multilingual
{
    protected static $strTable = 'tl_department';
}
