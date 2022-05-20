<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WordQuizTest extends WebTestCase
{
	/**
	 * Test for a word that does not exist in the dictionary
	 */
	public function testNonExistingWord(): void
	{
		// General test setup
		$client = static::createClient();

		// Input parameters for the test
		$word = 'grmbl';

		$messageToReturn = [
			'success' => false,
			'message' => 'Word not found',
			'score' => 0,
			'status_code' => 404
		];

		$expectedJsonResponse = json_encode($messageToReturn);

		// Act
		$client->request('GET', '/' . $word);

		// Assertions
		$this->assertResponseIsSuccessful();

		$actualResponseJson = $client->getResponse()->getContent();

		$this->assertJsonStringEqualsJsonString($expectedJsonResponse, $actualResponseJson);
	}

	 /**
	 * Test for a SIMPLE word (not palindrome nor almost palindrome)
	 */
	public function testSimpleWord(): void
	{
		// General test setup
		$client = static::createClient();

		// Input parameters for the test
		$word = 'bell';

		$messageToReturn = [
			'success' => true,
			'message' => 'Scored successfully',
			'score' => 3,
			'status_code' => 200
		];

		$expectedJsonResponse = json_encode($messageToReturn);

		// Act
		$client->request('GET', '/' . $word);

		// Assertions
		$this->assertResponseIsSuccessful();

		$actualResponseJson = $client->getResponse()->getContent();

		$this->assertJsonStringEqualsJsonString($expectedJsonResponse, $actualResponseJson);
	}

	public function testPalindrome(): void
	{
		// General test setup
		$client = static::createClient();

		// Input parameters for the test
		$word = 'rotor';

		$messageToReturn = [
			'success' => true,
			'message' => 'Scored successfully',
			'score' => 6,
			'status_code' => 200
		];

		$expectedJsonResponse = json_encode($messageToReturn);

		// Act
		$client->request('GET', '/' . $word);

		// Assertions
		$this->assertResponseIsSuccessful();

		$actualResponseJson = $client->getResponse()->getContent();

		$this->assertJsonStringEqualsJsonString($expectedJsonResponse, $actualResponseJson);
	}

	public function testAlmostPalindrome(): void
	{
		// General test setup
		$client = static::createClient();

		// Input parameters for the test
		$word = 'deeds';

		$messageToReturn = [
			'success' => true,
			'message' => 'Scored successfully',
			'score' => 5,
			'status_code' => 200
		];

		$expectedJsonResponse = json_encode($messageToReturn);

		// Act
		$client->request('GET', '/' . $word);

		// Assertions
		$this->assertResponseIsSuccessful();

		$actualResponseJson = $client->getResponse()->getContent();

		$this->assertJsonStringEqualsJsonString($expectedJsonResponse, $actualResponseJson);
	}
}
