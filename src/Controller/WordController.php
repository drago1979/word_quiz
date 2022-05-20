<?php


namespace App\Controller;

use App\Service\WordService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WordController extends AbstractController
{
	/**
	 * @param WordService $wordService
	 * @param string $word
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function process(WordService $wordService, string $word)
	{
		return $this->json($wordService->processWord($word));

	}
}