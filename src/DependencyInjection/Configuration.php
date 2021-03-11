<?php

declare(strict_types=1);

namespace Darake\SculpinCategoryListBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('sculpin_category_list');

        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
