<?php

/**
 * Merger² - Module Merger for Contao Open Source CMS.
 *
 * @package   Merger²
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @copyright 2013-2014 bit3 UG
 * @copyright 2015-2022 Contao Community Alliance
 * @license   https://github.com/contao-community-alliance/merger2/blob/master/LICENSE LGPL-3.0-or-later
 * @link      https://github.com/contao-community-alliance/merger2
 */

declare(strict_types=1);

namespace ContaoCommunityAlliance\Merger2;

use Contao\PageModel;

/**
 * Class PageProvider.
 *
 * @package ContaoCommunityAlliance\Merger2
 */
final class PageProvider
{
    /**
     * Get the current page.
     *
     * @return PageModel|null
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function getPage(): ?PageModel
    {
        return $GLOBALS['objPage'];
    }
}
