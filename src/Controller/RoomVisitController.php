<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Visit;
use App\Entity\RoomVisitLog;

class RoomVisitController extends AbstractController
{
    /**
     * @Route("/room/visit", name="room_visit")
     */
    public function index(): Response
    {
        return $this->render('room_visit/index.html.twig', [
            'controller_name' => 'RoomVisitController',
        ]);
    }

    /**
     * @Route("/room/visit/all", name="app_find_all_room_visit")
     */
    public function findAllRoomVisit(EntityManagerInterface $entityManager): Response
    {
        $logs = $entityManager
            ->getRepository(RoomVisitLog::class)
            ->findAll();
        //return $this->json($books);
        return $this->render('room_visit/find_all.html.twig', ['logs' => $logs]);
    }

    /**
     * @Route("/room/visit/{id}", defaults={"id=1"}, name="app_show_visits")
     */
    public function showVisits(int $id): Response
    {
        $log = $this->getDoctrine()
            ->getRepository(RoomVisitLog::class)
            ->find($id);

        $visits = $log->getVisits();

        //return $this->json($events);
        return $this->render('room_visit/find_all_visits.html.twig', ['visits' => $visits]);
    }
}
