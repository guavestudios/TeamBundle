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
 * @property string $detailPage
 * @property bool $published
 *
 * @method static JobDescriptionModel|null findById($id, array $opt = array())
 * @method static JobDescriptionModel|null findByPk($id, array $opt = array())
 * @method static JobDescriptionModel|null findOneBy($col, $val, array $opt = array())
 * @method static JobDescriptionModel|null findOneByPid($val, array $opt = array())
 * @method static JobDescriptionModel|null findOneByLangPid($val, array $opt = array())
 * @method static JobDescriptionModel|null findOneByLanguage($val, array $opt = array())
 * @method static JobDescriptionModel|null findOneBySorting($val, array $opt = array())
 * @method static JobDescriptionModel|null findOneByTstamp($val, array $opt = array())
 * @method static JobDescriptionModel|null findOneByName($val, array $opt = array())
 * @method static JobDescriptionModel|null findOneByAlias($val, array $opt = array())
 * @method static JobDescriptionModel|null findOneByDetailPage($val, array $opt = array())
 * @method static JobDescriptionModel|null findOneByPublished($val, array $opt = array())
 *
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findByPid($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findByLangPid($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findByLanguage($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findBySorting($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findByTstamp($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findByName($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findByAlias($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findByDetailPage($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findByPublished($val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findMultipleByIds($var, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findBy($col, $val, array $opt = array())
 * @method static Collection|JobDescriptionModel[]|JobDescriptionModel|null findAll(array $opt = array())
 *
 * @method static integer countById($id, array $opt = array())
 * @method static integer countByPid($val, array $opt = array())
 * @method static integer countByLangPid($val, array $opt = array())
 * @method static integer countByLanguage($val, array $opt = array())
 * @method static integer countBySorting($val, array $opt = array())
 * @method static integer countByTstamp($val, array $opt = array())
 * @method static integer countByName($val, array $opt = array())
 * @method static integer countByAlias($val, array $opt = array())
 * @method static integer countByDetailPage($val, array $opt = array())
 * @method static integer countByPublished($val, array $opt = array())
 */
class JobDescriptionModel extends Multilingual
{
    protected static $strTable = 'tl_job_description';

    public static function findPublishedById($arrIds, array $opt = []): ?Collection
    {
        return self::findBy(
            [self::$strTable . '.published = ? AND ' . self::$strTable . '.id IN (' . implode(', ', $arrIds) . ')'],
            [1],
            $opt
        );
    }
}
