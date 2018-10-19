<?php

namespace App\DataFixtures;

use App\Entity\Friend;
use App\Entity\Pyoupyou;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository(User::class)->findAll();

        foreach ($users as $user){
            $user->setPassword($this->encoder->encodePassword($user, $user-> getPassword())) ;
        }
        //

        $manager->flush();
    }
}
