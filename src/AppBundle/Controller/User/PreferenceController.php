<?php
namespace AppBundle\Controller\User;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Form\Type\UserType;
use AppBundle\Form\Type\PreferenceType;

use AppBundle\Entity\User;
use AppBundle\Entity\Preference;

class PreferenceController extends Controller

{
    /**
     * 
     * @Rest\View()
     * @Rest\Post("/users/{id}/preferences")
     */
    public function postTestAction(Request $request)
    {

        $user = $this->get('doctrine.orm.entity_manager')
                     ->getRepository('AppBundle:User')
                     ->find($request->get('id'));

        $preference = new Preference();
        $preference->setUser($user);

        $form = $this->createForm(PreferenceType::class,$preference);

        $form->submit($request->request->all());

        if($form->isValid())
        {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($preference);
            $em->flush();
            return $preference;
        }

        else
        {
            return $form;
        }
        return $preference;
    }
}
