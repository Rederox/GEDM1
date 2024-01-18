<?php
// src/Service/NotificationService.php

namespace App\Service;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;

class NotificationService {
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function createNotification($productId, $userId, $message) {
        $notification = new Notification();
        $notification->setProductId($productId);
        $notification->setUserId($userId);
        $notification->setMessage($message);
        $notification->setSendedAt(new \DateTimeImmutable());
        $notification->setStatus('send');

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }
}
