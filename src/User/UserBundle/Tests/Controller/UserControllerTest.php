<?php

namespace User\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use User\UserBundle\Entity\User;

class UserControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
    }

    public function testIndex() {
        $client = static::createClient();
        $route = $client->getContainer()->get('router')->generate('user', array(), false);
        $crawler = $client->request('GET', $route);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testNew() {
        $client = static::createClient();
        $route = $client->getContainer()->get('router')->generate('user_new', array(), false);
        $crawler = $client->request('GET', $route);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testShow() {
        $client = static::createClient();
        $users = $this->em->getRepository('UserUserBundle:User')->findAll();
        foreach ($users as $user) {
            $route = $client->getContainer()->get('router')->generate('user_show', array('id' => $user->getId()), false);
            $crawler = $client->request('GET', $route);
            $this->assertTrue($client->getResponse()->isSuccessful());
        }
    }

}
