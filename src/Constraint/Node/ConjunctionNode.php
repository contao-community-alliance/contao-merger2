<?php

/**
 * Merger² - Module Merger for Contao Open Source CMS.
 *
 * @package   Merger²
 * @author    Tristan Lins <tristan.lins@bit3.de>
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @copyright 2013-2014 bit3 UG
 * @copyright 2015-2022 Contao Community Alliance
 * @license   https://github.com/contao-community-alliance/merger2/blob/master/LICENSE LGPL-3.0-or-later
 * @link      https://github.com/contao-community-alliance/merger2
 */
declare(strict_types=1);

namespace ContaoCommunityAlliance\Merger2\Constraint\Node;

/**
 * Class ConjunctionNode.
 */
abstract class ConjunctionNode implements NodeInterface
{
    /**
     * Left node.
     *
     * @var NodeInterface
     */
    protected $left;

    /**
     * Right node.
     *
     * @var NodeInterface
     */
    protected $right;

    /**
     * ConjunctionNode constructor.
     *
     * @param NodeInterface $left  Left node.
     * @param NodeInterface $right Right node.
     */
    public function __construct(NodeInterface $left, NodeInterface $right)
    {
        $this->left  = $left;
        $this->right = $right;
    }

    /**
     * Set left node.
     *
     * @param NodeInterface $left Node.
     *
     * @return $this
     */
    public function setLeft(NodeInterface $left): self
    {
        $this->left = $left;

        return $this;
    }

    /**
     * Get left node.
     *
     * @return NodeInterface
     */
    public function getLeft(): NodeInterface
    {
        return $this->left;
    }

    /**
     * Set right node.
     *
     * @param NodeInterface $right Nde.
     *
     * @return $this
     */
    public function setRight(NodeInterface $right): self
    {
        $this->right = $right;

        return $this;
    }

    /**
     * Get the right node.
     *
     * @return NodeInterface
     */
    public function getRight(): NodeInterface
    {
        return $this->right;
    }
}
