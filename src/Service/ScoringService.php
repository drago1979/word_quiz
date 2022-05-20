<?php


namespace App\Service;


class ScoringService
{
	/**
	 * @var int
	 */
	private $score = 0;

	/**
	 * @param $word
	 * @return int
	 */
	public function scoreWord($word)
	{
		self::scoreUniqueLetters($word);

		if (!self::scorePalindrome($word)) {
			self::scoreAlmostPalindrome($word);
		}

		return $this->score;
	}

	/**
	 * @param string $word
	 * @return void
	 */
	private function scoreUniqueLetters(string $word): void
	{
		$this->score += count(array_unique(str_split($word)));
	}

	/**
	 * @param string $word
	 * @return void
	 */
	private function scorePalindrome(string $word): bool
	{
		if (self::isPalindrome($word)) {
			$this->score += 3;

			return true;
		};
		return false;
	}

	/**
	 * @param $word
	 * @return bool
	 */
	private function scoreAlmostPalindrome($word)
	{
		$k = 0;
		$j = strlen($word) - 1;

		while ($k < $j) {

			if (!($word[$k] === $word[$j])) {

				if (self::isPalindrome(substr_replace($word, '', $k, 1)) ||
					self::isPalindrome(substr_replace($word, '', $j, 1))) {

					$this->score += 2;

					return true;
				}
			}

			$k++;
			$j--;
		}
	}

	/**
	 * @param $word
	 * @return bool
	 */
	private static function isPalindrome($word)
	{
		$wordToCheck = $word;

		if (strrev($wordToCheck) == $word) {
			return true;
		}

		return false;
	}
}