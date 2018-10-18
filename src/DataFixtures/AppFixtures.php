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
        $pyoupyous= $manager->getRepository(Pyoupyou::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();
        $friends = $manager->getRepository(Friend::class)->findAll();

        foreach ($users as $user){
            foreach ($pyoupyous as $pyoupyou){
                if ($pyoupyou->getUser() == $user){
                    $user->addPyoupyou($pyoupyou);
                    $manager->persist($user);
                }

                if($user->getReposts()->contains($pyoupyou)){
                    $pyoupyou->addRepostUser($user);
                }
            }

            foreach ($friends as $friend){
                if($friend->getUserFrom() == $user){
                    $user->addFollower($friend);
                }
                elseif ($friend->getUserTo() == $user){
                    $user->addFollowed($friend);
                }
                $manager->persist($user);
            }

            $user->setPassword($this->encoder->encodePassword($user, $user-> getPassword())) ;
        }
        //

        $manager->flush();
    }
}
