<?php

declare(strict_types=1);

/*
 * This file is part of Contao Links Bundle.
 *
 * (c) Hamid Peywasti 2014-2024 <hamid@respinar.com>
 *
 * @license LGPL-3.0-or-later
 */

/**
 * Run in a custom namespace, so the class can be replaced.
 */

namespace Respinar\Links\Model;

use Contao\Model;
use Contao\Model\Collection;

/**
 * Reads and writes Members Act.
 */
class LinksModel extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected static $strTable = 'tl_links';

    /**
     * Find published link items by their parent ID.
     */
    public static function findPublishedByPids(array $arrPids, bool|null $blnFeatured = null, int $intLimit = 0, int $intOffset = 0, array $arrOptions = []): Collection|null
    {
        if ([] === $arrPids) {
            return null;
        }

        $t = static::$strTable;
        $arrColumns = ["$t.pid IN(".implode(',', array_map('intval', $arrPids)).')'];

        /*if ($blnFeatured === true)
        {
            $arrColumns[] = "$t.featured=1";
        }
        elseif ($blnFeatured === false)
        {
            $arrColumns[] = "$t.featured=''";
        }*/

        // Never return unpublished elements in the back end, so they don't end up in the
        // RSS feed
        if (!static::isPreviewMode($arrOptions)) {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        if (!isset($arrOptions['order'])) {
            $arrOptions['order'] = "$t.sorting";
        }

        $arrOptions['limit'] = $intLimit;
        $arrOptions['offset'] = $intOffset;

        return static::findBy($arrColumns, null, $arrOptions);
    }

    /**
     * Count published link items by their parent ID.
     */
    public static function countPublishedByPids(array $arrPids, bool|null $blnFeatured = null, array $arrOptions = []): int
    {
        if ([] === $arrPids) {
            return 0;
        }

        $t = static::$strTable;
        $arrColumns = ["$t.pid IN(".implode(',', array_map('intval', $arrPids)).')'];

        /*if ($blnFeatured === true)
        {
            $arrColumns[] = "$t.featured=1";
        }
        elseif ($blnFeatured === false)
        {
            $arrColumns[] = "$t.featured=''";
        }*/

        if (!BE_USER_LOGGED_IN) {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        return static::countBy($arrColumns, null, $arrOptions);
    }
}
