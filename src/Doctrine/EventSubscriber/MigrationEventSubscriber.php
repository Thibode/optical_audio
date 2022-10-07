<?php
declare(strict_types=1);
namespace App\Doctrine\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;

class MigrationEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return ['postGenerateSchema'];
    }
    public function postGenerateSchema(GenerateSchemaEventArgs $eventArgs): void
    {
        $schema = $eventArgs->getSchema();
        if (!$schema->hasNamespace('public')) {
            $schema->createNamespace('public');
        }
    }
}