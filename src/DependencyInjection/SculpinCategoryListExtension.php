<?php

namespace Darake\SculpinCategoryListBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SculpinCategoryListExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration;
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $taxonomyTypes = array_key_exists('taxonomy_types', $config) ? $config['taxonomy_types'] : ['categories', 'tags'];

        $container->setParameter('sculpin_category_list.taxonomy_types', $taxonomyTypes);
    }
}
