<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'TwigEnvironment' => 'ZF2Twig\Environment\EnvironmentFactory',
            'TwigLoaderFilesystem' => 'ZF2Twig\Loader\FilesystemFactory',
            'ViewTwigRenderer' => 'ZF2Twig\View\Renderer\TwigRendererFactory',
            'ViewTwigResolver' => 'ZF2Twig\View\Resolver\TwigResolverFactory',
            'ViewTwigStrategy' => 'ZF2Twig\View\Strategy\TwigStrategyFactory',
            'ZFTwigPluginProvider' => 'ZF2Twig\Environment\PluginProviderFactory',
        ),
        'invokables' => array(
            'ZFHelperExtension' => 'ZF2Twig\Extension\ZFHelper',
        ),
    ),
    'zf2twig' => array(
        'default_suffix' => 'twig',
        'environment_options' => array(),
        'extensions' => array(
        ),
    ),
);
