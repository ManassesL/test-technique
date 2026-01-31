<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Message\ProductUpdatedMessage;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Messenger\MessageBusInterface;

class ProductEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->handleProductEvent($args, 'created');
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->handleProductEvent($args, 'updated');
    }

    private function handleProductEvent(LifecycleEventArgs $args, string $action): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Product) {
            return;
        }

        $this->messageBus->dispatch(
            new ProductUpdatedMessage($entity->getId(), $action)
        );
    }
}