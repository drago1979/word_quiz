<?php

namespace App\Service;


use phpDocumentor\Reflection\Types\This;

class WordService
{
	/**
	 * @var DictionaryService
	 */
	private $dictionaryService;

	/**
	 * @var
	 */
	private $scoringService;


	/**
	 * WordService constructor.
	 * @param DictionaryService $dictionaryService
	 * @param ScoringService $scoringService
	 */
	public function __construct(DictionaryService $dictionaryService, ScoringService $scoringService)
	{
		$this->dictionaryService = $dictionaryService;
		$this->scoringService = $scoringService;

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

		$score = $this->scoringService->scoreWord($word);

		return ResponseService::response(true, 'Scored successfully', $score, 200);
	}
}
