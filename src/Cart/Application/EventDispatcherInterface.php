<?php

namespace Devkick\Cart\Application;

use Devkick\Cart\Domain\Event\EventInterface;

interface EventDispatcherInterface
{
    public function dispatch(EventInterface $event): void;
}
