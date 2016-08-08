<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DashboardController
 * @package AppBundle\Controller
 */
class DashboardController extends Controller
{
    /**
     * @Route("/", name="app_dashboard_index")
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute('app_shop_index');
    }
}
