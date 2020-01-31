<?php

namespace AppBundle\Controller\Place;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Form\Type\PriceType;
use AppBundle\Entity\Price;

class PriceController extends Controller
{
   
     /**
     * @Rest\View()
     * @Rest\Get("/places/{id}/prices")
     */
    public function getPricesAction()
    {
        
    }

   /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/places/{id}/prices")
     */
    public function postPricesAction(Request $request)
    {

        $place = $this->get('doctrine.orm.entity_manager')
                      ->getRepository('AppBundle:Place')
                      ->find($request->get('id'));
     
        $price = new Price();

        $price->setPlace($place);

        $form = $this->createForm(PriceType::class, $price);
       
        $form->submit($request->request->all());//

        

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($price);
            $em->flush();
            return $price;
        } else {
            return $form;
        }
    }

}