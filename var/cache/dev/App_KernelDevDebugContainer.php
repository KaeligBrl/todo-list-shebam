<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXVIV7qr\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXVIV7qr/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerXVIV7qr.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerXVIV7qr\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerXVIV7qr\App_KernelDevDebugContainer([
    'container.build_hash' => 'XVIV7qr',
    'container.build_id' => 'dd5fb3fb',
    'container.build_time' => 1619711462,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerXVIV7qr');
