<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Entity\Notification;
use App\Entity\User;



class ActionController extends AbstractController
{

    #[Route('/api/notification/delete', name: 'delete_notification', methods: ['POST'])]
    public function deleteNotification(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $notificationId = $data['notificationId'] ?? null;
    
        if (!$notificationId) {
            return $this->json([
                'code' => 400,
                'message' => 'ID de notification manquant',
            ], 400);
        }
    
        $notification = $entityManager->getRepository(Notification::class)->find($notificationId);
    
        if (!$notification) {
            return $this->json([
                'code' => 404,
                'message' => 'Notification non trouvée',
            ], 404);
        }
    
        $entityManager->remove($notification);
        $entityManager->flush();
    
        return $this->json([
            'code' => 200,
            'message' => 'Notification supprimée',
        ], 200);
    }
}
