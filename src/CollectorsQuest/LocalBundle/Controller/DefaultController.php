<?php

namespace CollectorsQuest\LocalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CollectorsQuestLocalBundle:Default:index.html.twig');
    }

    public function privacyAction()
    {
        return $this->render('CollectorsQuestLocalBundle:Default:privacy.html.twig');
    }
}
