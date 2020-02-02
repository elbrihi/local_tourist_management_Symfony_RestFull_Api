<?php

namespace AppBundle\Controller\Place ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Form\Type\PriceType;
use AppBundle\Form\Type\ThemeType;

use AppBundle\Entity\Price;
use AppBundle\Entity\Place;
use AppBundle\Entity\Theme;

class ThemeController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"theme"})
     * @Rest\Post("/places/{id}/themes")
     */
    public function postThemesAction(Request $request)
    {
        $place = $this->get('doctrine.orm.entity_manager')
                    ->getRepository('AppBundle:Place')
                    ->find($request->get('id'));
        
        
        if (empty($place)) {
            return $this->placeNotFound();
        }
        $theme = new Theme();

        $form = $this->createForm(ThemeType::class, $theme);
        
        $theme->setPlace($place);

      
        $form->submit($request->request->all());// 
        
        if($form->isValid())
        {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($theme);
            $em->flush();
            return $theme;
        } else {
            return $form;
        }
    }

     /**
     * @Rest\View(serializerGroups={"theme"})
     * @Rest\Get("/places/{id}/themes")
     */
    public function getThemeAction(Request $request)
    {
        $theme = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Theme')
                ->find($request->get('id'));
        return $theme;
    }

    private function placeNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
    }
}