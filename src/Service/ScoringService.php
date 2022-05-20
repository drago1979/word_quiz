<?php


namespace App\Service;


class ScoringService
{
	private static $score = 0;

	public static function scoreWord($word)
	{
		self::scoreUniqueLetters($word);

		if (!self::scorePalindrome($word)) {
			self::scoreAlmostPalindrome($word);
		}

		return self::$score;

	}

	/**
	 * @param string $word
	 * @return void
	 */
	public static function scoreUniqueLetters(string $word): void
	{
		self::$score += count(array_unique(str_split($word)));
	}

	/**
	 * @param string $word
	 * @return void
	 */
	public static function scorePalindrome(string $word): bool
	{
		if (self::isPalindrome($word)) {
			self::$score += 3;

			return true;
		};
		return false;
	}

	public static function scoreAlmostPalindrome($word)
	{
		$k = 0;
		$j = strlen($word) - 1;

		while ($k < $j) {

			if (!($word[$k] === $word[$j])) {

				if (self::isPalindrome(substr_replace($word, '', $k, 1)) ||
					self::isPalindrome(substr_replace($word, '', $j, 1))) {

					self::$score = 2;
					return true;
				}
			}

			$k++;
			$j--;
		}
	}

	public static function isPalindrome($word)
	{
		$wordToCheck = $word;

		if (strrev($wordToCheck) == $word) {
			return true;
		}

		return false;
	}
}