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

namespace ContaoCommunityAlliance\Merger2\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * FunctionCollectionCompilerPass finds all tagged function collections and passes them to the default
 * function collection.
 *
 * @package ContaoCommunityAlliance\Merger2\DependencyInjection
 */
final class FunctionCollectionCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has('cca.merger2.function_collection')) {
            return;
        }

        $definition       = $container->findDefinition('cca.merger2.function_collection');
        $taggedServiceIds = $container->findTaggedServiceIds('cca.merger2.function');
        $services         = (array) $definition->getArgument(0);

        foreach (array_keys($taggedServiceIds) as $serviceId) {
            $services[] = new Reference($serviceId);
        }

        $definition->replaceArgument(0, $services);
    }
}
