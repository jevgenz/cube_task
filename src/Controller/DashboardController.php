<?php

namespace App\Controller;

use SimpleXMLElement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
	/**
	 * @Route("/dashboard", name="dashboard")
	 */
	public function index()
	{
		$rss = simplexml_load_file('https://www.tvnet.lv/rss');
		return $this->render('dashboard/index.html.twig', [
			'rss' => $rss,
		]);
	}
}
