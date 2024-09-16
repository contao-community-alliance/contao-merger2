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

namespace ContaoCommunityAlliance\Merger2\Functions;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\PageModel;
use ContaoCommunityAlliance\Merger2\Functions\Description\Argument;
use ContaoCommunityAlliance\Merger2\Functions\Description\Description;
use ContaoCommunityAlliance\Merger2\PageProvider;

/**
 * Class RootFunction.
 *
 * @package ContaoCommunityAlliance\Merger2\Functions
 */
final class RootFunction extends AbstractPageFunction
{
    /**
     * Contao framework.
     *
     * @var ContaoFramework
     */
    private $framework;

    /**
     * Construct.
     *
     * @param PageProvider    $pageProvider Page provider.
     * @param ContaoFramework $framework    Contao framework.
     */
    public function __construct(PageProvider $pageProvider, ContaoFramework $framework)
    {
        parent::__construct($pageProvider);

        $this->framework = $framework;
    }

    /**
     * Function: root(..).
     *
     * Test the root page id or alias.
     *
     * @param mixed $pageId Page id or alias.
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __invoke($pageId): bool
    {
        $page = $this->pageProvider->getPage();

        if ($page === null) {
            return false;
        }

        if (is_numeric($pageId)) {
            return (int) $pageId === (int) $page->rootId;
        }

        /** @var PageModel $adapter */
        $adapter  = $this->framework->getAdapter(PageModel::class);
        $rootPage = $adapter->findByPK($page->rootId);

        return $pageId === $rootPage?->alias;
    }

    /**
     * {@inheritDoc}
     */
    public function describe(): Description
    {
        return Description::create(static::getName())
            ->setDescription('Test the root page id or alias.')
            ->addArgument('pageId')
                ->setDescription('Page id or alias')
                ->setType(Argument::TYPE_INTEGER | Argument::TYPE_STRING)
            ->end();
    }
}
