<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Achievement;
use App\Entity\AchievementLog;

class AchievementController extends AbstractController
{
    /**
     * @Route("/log", name="log")
     */
    public function index(): Response
    {
        return $this->render('log/index.html.twig', [
            'controller_name' => 'AchievementController',
        ]);
    }

    /**
     * @Route("/log/all", name="app_find_all_log")
     */
    public function findAllLog(EntityManagerInterface $entityManager): Response
    {
        $logs = $entityManager
            ->getRepository(AchievementLog::class)
            ->findAll();
        //return $this->json($books);
        return $this->render('log/find_all.html.twig', ['logs' => $logs]);
    }

    /**
     * @Route("/log/{id}", defaults={"id=1"}, name="app_show_events")
     */
    public function showEvents(int $id): Response
    {
        $log = $this->getDoctrine()
            ->getRepository(AchievementLog::class)
            ->find($id);

        $achievements = $log->getAchievements();

        //return $this->json($events);
        return $this->render('log/find_all_events.html.twig', ['events' => $achievements]);
    }
}
