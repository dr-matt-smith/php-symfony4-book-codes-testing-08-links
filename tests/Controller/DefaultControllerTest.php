<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class DefaultControllerTest extends WebTestCase
{
    public function testHomepageResponseCodeOkay()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();

        // Assert
        $client->request($httpMethod, $url);

        // Assert
        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testHomepageContentContainsHomePage()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'home page';

        // Act
        $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();

        // to lower case
        $searchTextLowerCase = strtolower($searchText);
        $contentLowerCase = strtolower($content);

        // Assert
        $this->assertContains(
            $searchTextLowerCase,
            $contentLowerCase
        );
    }


    public function testAboutPageContentContainsAbout()
    {
        // Arrange
        $url = '/about';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'about';

        // Act
        $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();

        // to lower case
        $searchTextLowerCase = strtolower($searchText);
        $contentLowerCase = strtolower($content);

        // Assert
        $this->assertContains(
            $searchTextLowerCase,
            $contentLowerCase
        );
    }


    /**
     * @dataProvider basicPagesTextProvider
     */
    public function testPublicPagesContainBasicText($url, $exepctedLowercaseText)
    {
        // Arrange
        $httpMethod = 'GET';
        $client = static::createClient();

        // Act
        $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $statusCode = $client->getResponse()->getStatusCode();

        // to lower case
        $contentLowerCase = strtolower($content);

        // Assert - status code 200
        $this->assertSame(Response::HTTP_OK, $statusCode);

        // Assert - expected content
        $this->assertContains(
            $exepctedLowercaseText,
            $contentLowerCase
        );
    }

    public function basicPagesTextProvider()
    {
        return [
            ['/', 'home page'],
            ['/about', 'about'],
        ];
    }


    public function testHomePageLinkToAboutWorks()
    {
        // Arrange
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'about page';
        $linkText = 'about';

        // Act
        $crawler = $client->request($httpMethod, $url);
        $link = $crawler->selectLink($linkText)->link();
        $client->click($link);
        $content = $client->getResponse()->getContent();

        // to lower case
        $searchTextLowerCase = strtolower($searchText);
        $contentLowerCase = strtolower($content);

        // Assert
        $this->assertContains($searchTextLowerCase, $contentLowerCase);
    }



}