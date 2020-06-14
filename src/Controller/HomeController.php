<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $repo;
    private $em;

    public function __construct(EntityManagerInterface $em, PropertyRepository $repo)
    {
        $this->em = $em;
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $properties = $this->repo->findByLast();
        return $this->render('pages/home.html.twig',[
            "current_menu" => "home",
            "properties" => $properties
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig', [
            "current_menu" => "contact"
        ]);
    }
}