<?php

namespace App\Service;


class WordService
{
	/**
	 * @var DictionaryService
	 */
	private $dictionaryService;

	/**
	 * WordService constructor.
	 * @param DictionaryService $dictionaryService
	 */
	public function __construct(DictionaryService $dictionaryService)
	{
		$this->dictionaryService = $dictionaryService;
	}

	/**
	 * @param string $word
	 * @return array
	 */
	public function processWord(string $word): array
	{
		$score = 0;

		if (!(true === $this->dictionaryService->checkIfWordExists($word))) {
			return ResponseService::response(false, 'Word not found', $score, 404);
		}

		$score = ScoringService::scoreWord($word);

		return ResponseService::response(true, 'Scored successfully', $score, 200);
	}
}
