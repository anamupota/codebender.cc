<?php

namespace Ace\StaticBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerFunctionalTest extends WebTestCase
{
	public function testAboutAction_Generic()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/about');

		$this->assertEquals(1, $crawler->filter('html:contains("we help you write and share code")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("State of the art editor. Awesome compiler.")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Hassle-free. USB cable or the cloud. It doesn\'t matter.")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("From DIY to DIT. Share and Collaborate.")')->count());
		$this->assertGreaterThanOrEqual(3, $crawler->filter('h3')->count());
		$this->assertGreaterThanOrEqual(3, $crawler->filter('h4')->count());
	}

	public function testAboutAction_LoggedIn()
	{
		$client = static::createClient(array(), array(
			'PHP_AUTH_USER' => 'tester',
			'PHP_AUTH_PW' => 'testerPASS',
		));

		$crawler = $client->request('GET', '/static/about');
		$this->assertEquals(1, $crawler->filter('html:contains("we help you write and share code")')->count());
		$this->assertEquals(0, $crawler->filter('input[value=Register]')->count());
	}

	public function testAboutAction_Anonymous()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/about');

		$this->assertEquals(1, $crawler->filter('html:contains("Sign Up")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Start coding in minutes.")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Hi! Why don\'t you sign up for a codebender account?")')->count());
		$this->assertEquals(1, $crawler->filter('input[value=Register]')->count());
	}

	public function testTechAction()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/tech');

		$this->assertEquals(1, $crawler->filter('html:contains("Cloud IDE")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Makers\' Hub")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Documentation and Suggestions")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("under the hood")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Open Source")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Ariadne Bootloader")')->count());
		$this->assertGreaterThanOrEqual(2, $crawler->filter('h1')->count());
		$this->assertGreaterThanOrEqual(11, $crawler->filter('h3')->count());
		$this->assertGreaterThanOrEqual(12, $crawler->filter('h4')->count());
	}

	public function testTeamAction()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/team');

		$this->assertEquals(1, $crawler->filter('html:contains("Vasilis Georgitzikis")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Stelios Tsampas")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Dimitris Amaxilatis")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Maria Kousta")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Markellos Orfanos")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Dimitris Dimakopoulos")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Dimitrios Christidis")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Alexandros Baltas")')->count());
		$this->assertGreaterThanOrEqual(8, $crawler->filter('h2')->count());
		$this->assertGreaterThanOrEqual(3, $crawler->filter('h1')->count());
	}

	public function testTutorialsAction()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/tutorials');

		$this->assertEquals(1, $crawler->filter('html:contains("Learn how to use codebender")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Walkthrough Video!")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Plugin Tutorial!")')->count());
		$this->assertGreaterThanOrEqual(1, $crawler->filter('h1')->count());
		$this->assertGreaterThanOrEqual(2, $crawler->filter('h3')->count());
	}

	public function testWalkthroughAction_ValidPages()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/walkthrough/page/1');
		$this->assertEquals(1, $crawler->filter('html:contains("Feel the magic!")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Page 1 of")')->count());

		//TODO: Make this more interactive. i.e. pressing the button instead of moving to the next page
		$crawler = $client->request('GET', '/static/walkthrough/page/2');
		$this->assertEquals(1, $crawler->filter('html:contains("Page 2 of")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Please wait")')->count());

		$crawler = $client->request('GET', '/static/walkthrough/page/3');
		$this->assertEquals(1, $crawler->filter('html:contains("Page 3 of")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Please wait")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("We strongly encourage you to install")')->count());

		$crawler = $client->request('GET', '/static/walkthrough/page/4');
		$this->assertEquals(1, $crawler->filter('html:contains("Page 4 of")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Start")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("You should now have all the necessary")')->count());

		$crawler = $client->request('GET', '/static/walkthrough/page/5');
		$this->assertEquals(1, $crawler->filter('html:contains("Page 5 of")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Congratulations!")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Congratulations, you just completed the")')->count());
	}

	public function testWalkthroughAction_LandingPageLoggedIn()
	{
		$client = static::createClient(array(), array(
			'PHP_AUTH_USER' => 'tester',
			'PHP_AUTH_PW' => 'testerPASS',
		));

		$crawler = $client->request('GET', '/static/walkthrough/page/5');
		$this->assertEquals(1, $crawler->filter('html:contains("Page 5 of")')->count());
		$this->assertEquals(0, $crawler->filter('input[value=Register]')->count());
	}

	public function testWalkthroughAction_LandingPageAnonymous()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/walkthrough/page/5');
		$this->assertEquals(1, $crawler->filter('html:contains("Sign Up")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Start coding in minutes.")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Hi! Why don\'t you sign up for a codebender account?")')->count());
		$this->assertEquals(1, $crawler->filter('input[value=Register]')->count());
	}

	public function testWalkthroughAction_Invalid()
	{
		$client = static::createClient();

		$client->request('GET', '/static/walkthrough/page/0');
		$this->assertTrue($client->getResponse()->isRedirect());

		$client->request('GET', '/static/walkthrough/page/6');
		$this->assertTrue($client->getResponse()->isRedirect());
	}

	public function testPluginAction()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/plugin');

		$this->assertEquals(1, $crawler->filter('html:contains("Firefox")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Google Chrome")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("All Browsers - Windows & Mac")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("The Plugin")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Downloading the correct plugin for your browser or OS!")')->count());
		$this->assertGreaterThanOrEqual(1, $crawler->filter('h1')->count());
		$this->assertGreaterThanOrEqual(3, $crawler->filter('h3')->count());
	}

	public function testPartnerAction_Digispark()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/partner/digispark');

		$this->assertEquals(1, $crawler->filter('html:contains("The micro-sized, Arduino enabled, usb development board - cheap enough to leave in any project!")')->count());
	}

	public function testPartnerAction_Arno()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/partner/arno');

		$this->assertEquals(1, $crawler->filter('html:contains("Learning the basics of electronics and programming is challenging")')->count());
	}

	public function testPartnerAction_Invalid()
	{
		$client = static::createClient();

		$client->request('GET', '/static/partner/invalid');
		$this->assertTrue($client->getResponse()->isRedirect());
	}

	public function testInfoPointsAction()
	{
		$client = static::createClient(array(), array(
			'PHP_AUTH_USER' => 'tester',
			'PHP_AUTH_PW' => 'testerPASS',
		));

		$crawler = $client->request('GET', '/static/info/points');
		$this->assertEquals(1, $crawler->filter('html:contains("?referrer=tester")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Do good. Get T-Shirts!")')->count());
	}

	public function testInfoKarmaAction()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/static/info/karma');

		$this->assertEquals(1, $crawler->filter('html:contains("What is karma?")')->count());
		$this->assertEquals(1, $crawler->filter('html:contains("Karma in codebender")')->count());
	}
}
