<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerWXD1I6I\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerWXD1I6I/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerWXD1I6I.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerWXD1I6I\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerWXD1I6I\App_KernelDevDebugContainer([
    'container.build_hash' => 'WXD1I6I',
    'container.build_id' => '6341dcaf',
    'container.build_time' => 1624267242,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerWXD1I6I');
