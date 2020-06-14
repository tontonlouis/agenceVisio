<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController 
{

    private $repo;

    public function __construct(PropertyRepository $repo)
    {
        $this->repo = $repo;
        
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $pagination = $paginator->paginate($this->repo->findAllQuery(), $request->get('page',1), 9);

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $pagination
        ]);
    }

    /**
     * @Route("/biens/{id}", name="property.show")
     */
    public function show(Property $property)
    {
        return $this->render('property/show.html.twig',[
            "property" => $property
        ]);
    }

}