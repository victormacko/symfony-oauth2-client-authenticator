<?php

namespace VictorMacko\AuthenticatorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use VictorMacko\AuthenticatorBundle\Security\GoogleAuthenticator;
use VictorMacko\AuthenticatorBundle\Security\UserProvider;

class AuthenticatorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

        $this->addAnnotatedClassesToCompile([
            // you can define the fully qualified class names...
            GoogleAuthenticator::class,
            UserProvider::class,
        ]);

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(GoogleAuthenticator::class);

        $definition->replaceArgument('$roles', $config['roles']);
        $definition->replaceArgument('$clientName', $config['client']);
        $definition->replaceArgument('$checkRoute', $config['check_route']);
    }
}