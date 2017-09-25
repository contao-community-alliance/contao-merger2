<?php

/**
 * Merger² - Module Merger for Contao Open Source CMS.
 *
 * @package   Merger²
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @copyright 2013-2014 bit3 UG
 * @copyright 2015-2017 Contao Community Alliance
 * @license   https://github.com/contao-community-alliance/merger2/blob/master/LICENSE LGPL-3.0+
 * @link      https://github.com/contao-community-alliance/merger2
 */

namespace ContaoCommunityAlliance\Merger2\Functions;

use ContaoCommunityAlliance\Merger2\Functions\Description\Argument;
use ContaoCommunityAlliance\Merger2\Functions\Description\Description;
use ContaoCommunityAlliance\Merger2\PageProvider;
use Doctrine\DBAL\Connection;

/**
 * Class ChildrenFunction.
 *
 * @package ContaoCommunityAlliance\Merger2\Functions
 */
class ChildrenFunction extends AbstractPageFunction
{
    /**
     * Database connection.
     *
     * @var Connection
     */
    private $connection;

    /**
     * Construct.
     *
     * @param PageProvider $pageProvider Page provider.
     * @param Connection   $connection   Database connection.
     */
    public function __construct(PageProvider $pageProvider, Connection $connection)
    {
        parent::__construct($pageProvider);

        $this->connection = $connection;
    }

    /**
     * Function: children(..).
     *
     * Test if the page have the specific count of children.
     *
     * @param int  $count              Count of children.
     * @param bool $includeUnpublished Include unpublished pages.
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __invoke($count, $includeUnpublished = false)
    {
        $time  = time();
        $query = 'SELECT COUNT(id) as count FROM tl_page WHERE pid=?';

        if ($includeUnpublished) {
            $query    .= ' AND (start=\'\' OR start<?) AND (stop=\'\' OR stop>?) AND published=1 LIMIT 0,1';
            $statement = $this->connection->prepare($query);

            $statement->bindValue(2, $time);
            $statement->bindValue(3, $time);
        } else {
            $statement = $this->connection->prepare($query);
        }

        $statement->bindValue(1, $this->pageProvider->getPage()->id);

        if ($statement->execute()) {
            return $statement->fetchColumn('count') >= $count;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function describe()
    {
        return Description::create(static::getName())
            ->setDescription('Test if the page have the specific count of children.')
            ->addArgument('count')
                ->setDescription('Count of children.')
                ->setType(Argument::TYPE_INTEGER)
            ->end()
            ->addArgument('includeUnpublished')
                ->setDescription('Include unpublished pages.')
                ->setType(Argument::TYPE_BOOLEAN)
                ->setDefaultValue(false)
            ->end();
    }
}
