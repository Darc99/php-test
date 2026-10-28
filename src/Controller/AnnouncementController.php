<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnnouncementController extends AbstractController
{
    #[Route('/new_announcement/{message}', name: 'announcement_new')]
    public function new(string $message, EntityManagerInterface $em): Response
    {
        $announcement = new Announcement();
        $announcement->setMessage($message);
        $announcement->setTimestamp(new \DateTimeImmutable());

        $em->persist($announcement);
        $em->flush();

        return new Response('Saved announcement with id ' . $announcement->getId());
    }

    #[Route('/announcement/{id}', name: 'announcement_show', requirements: ['id' => '\d+'])]
    public function show(Announcement $announcement): Response
    {
        return $this->render('announcement/show.html.twig', [
            'announcement' => $announcement,
        ]);
    }

    #[Route('/announcements', name: 'announcement_list')]
    public function list(AnnouncementRepository $repository): Response
    {
        return $this->render('announcement/list.html.twig', [
            'announcements' => $repository->findBy([], ['timestamp' => 'DESC']),
        ]);
    }


}
