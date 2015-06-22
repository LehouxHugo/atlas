<?php
namespace ADM\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ADM\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('Hugo');
        $user1->setEmail('hugo.lehoux@gmail.com');
        $user1->setPassword('cornusie');
        $user1->setEnabled(true);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Ernst');
        $user2->setEmail('ernst.gumpinger@gmail.com');
        $user2->setPassword('cornusie');
        $user2->setEnabled(true);
        $manager->persist($user2);

        $manager->flush();
    }
}