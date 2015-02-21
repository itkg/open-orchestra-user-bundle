<?php

namespace OpenOrchestra\UserBundle\Controller;

use FOS\UserBundle\Event\UserEvent;
use OpenOrchestra\UserBundle\Document\User;
use OpenOrchestra\UserBundle\UserEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 *
 * @Config\Route("user")
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     *
     * @Config\Route("/new", name="open_orchestra_user_new")
     * @Config\Method({"GET", "POST"})
     *
     * @return Response
     */
    public function newAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(
            'registration_user',
            $user,
            array(
                'action' => $this->generateUrl('open_orchestra_user_new')
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->saveUser($user);

            $url = $this->generateUrl('open_orchestra_user_user_form', array('userId' => $user->getId()));

            $this->dispatchEvent(UserEvents::USER_CREATE, new UserEvent($user, $request));

            return $this->redirect($url);
        }

        return $this->render('OpenOrchestraUserBundle:Editorial:template.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param string  $userId
     *
     * @Config\Route("/form/{userId}", name="open_orchestra_user_user_form")
     * @Config\Method({"GET", "POST"})
     *
     * @return Response
     */
    public function formAction(Request $request, $userId)
    {
        $user = $this->get('open_orchestra_user.repository.user')->find($userId);

        $form = $this->createForm(
            'user',
            $user,
            array(
                'action' => $this->generateUrl('open_orchestra_user_user_form', array(
                    'userId' => $userId,
                ))
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->saveUser($user);
            $this->dispatchEvent(UserEvents::USER_UPDATE, new UserEvent($user, $request));
        }

        return $this->render('OpenOrchestraUserBundle:Editorial:template.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param $user
     */
    protected function saveUser($user)
    {
        $documentManager = $this->get('doctrine.odm.mongodb.document_manager');
        $documentManager->persist($user);
        $documentManager->flush();

        $this->get('session')->getFlashBag()->add(
            'success',
            $this->get('translator')->trans('open_orchestra_user.new.success')
        );
    }

    /**
     * @param string $eventName
     * @param Event  $event
     */
    protected function dispatchEvent($eventName, $event)
    {
        $this->get('event_dispatcher')->dispatch($eventName, $event);
    }
}
