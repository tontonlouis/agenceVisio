<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController 
{

    private $repo;

    public function __construct(PropertyRepository $repo)
    {
        $this->repo = $repo;
        
    }
    /**
     * @Route("/property/{id}", name="property.show")
     */
    public function show(int $id)
    {
        $property = $this->repo->find($id);
        
        return $this->render('property/show.html.twig',[
            "property" => $property
        ]);
    }


}