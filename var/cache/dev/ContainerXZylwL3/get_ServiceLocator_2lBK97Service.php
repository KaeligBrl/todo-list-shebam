<?php

namespace ContainerXZylwL3;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_2lBK97Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.2lBK97_' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.2lBK97_'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'tache' => ['privates', '.errored..service_locator.2lBK97_.App\\Entity\\Tache', NULL, 'Cannot autowire service ".service_locator.2lBK97_": it references class "App\\Entity\\Tache" but no such service exists.'],
        ], [
            'tache' => 'App\\Entity\\Tache',
        ]);
    }
}
