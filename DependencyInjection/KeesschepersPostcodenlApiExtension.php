<?php

namespace Keesschepers\PostcodenlApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class KeesschepersPostcodenlApiExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('keesschepers_postcodenl_api.user', $config['api_user']);
        $container->setParameter('keesschepers_postcodenl_api.secret', $config['api_secret']);
        $container->setParameter('keesschepers_postcodenl_api.url', $config['base_url']);
        $container->setParameter('keesschepers_postcodenl_api.timeout', $config['timeout']);
    }
}
