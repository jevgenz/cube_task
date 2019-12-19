<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
	/**
	 * @Route("/news", name="news")
	 */
	public function index()
	{
		$rss = simplexml_load_file('https://www.tvnet.lv/rss');
		return $this->render('news/index.html.twig', [
			'rss' => $rss,
		]);
	}
}
