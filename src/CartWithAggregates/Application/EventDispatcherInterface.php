<?php

namespace Devkick\CartWithAggregates\Application;


use Devkick\CartWithAggregates\Domain\Commons\EventInterface;

interface EventDispatcherInterface
{
    public function dispatch(EventInterface $event): void;
}
