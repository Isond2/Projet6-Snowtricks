<?php

namespace ST\PlatformBundle\DataFixtures\ORM;

use ST\PlatformBundle\Entity\Figure;
use ST\PlatformBundle\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class AppFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $figure1 = new Figure();
        $figure1->setNom('Premiere yayee');
        $figure1->setDescription('ezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz lifezzzz life');
        $figure1->setGroupe('Groupe 1');
        $figure1->setImage('beach.jpg');
        $figure1->setVideo('nope');
        $this->addReference('figure-1', $figure1);
        $manager->persist($figure1);

        $figure2 = new Figure();
        $figure2->setNom('Seconde');
        $figure2->setDescription('SalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSafigurelutSalutSalutSalut SalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalutSalut');
        $figure2->setGroupe('Groupe 2');
        $figure2->setImage('beach.jpg');
        $figure2->setVideo('nope');
        $this->addReference('figure-2', $figure2);
        $manager->persist($figure2);
        $manager->flush();
    
             $comment = new Comment();
            $comment->setUser('symfony');
            $comment->setComment('To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.');
            $comment->setfigure($manager->merge($this->getReference('figure-1')));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('David');
            $comment->setComment('To make a long story short. Choosing a framework must not be taken lightly; it is a long-term commitment. Make sure that you make the right selection!');
            $comment->setfigure($manager->merge($this->getReference('figure-1')));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('Dade');
            $comment->setComment('Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.');
            $comment->setfigure($manager->merge($this->getReference('figure-2')));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('Kate');
            $comment->setComment('Are you challenging me? ');
            $comment->setfigure($manager->merge($this->getReference('figure-2')));
            $comment->setCreated(new \DateTime("2011-07-23 06:15:20"));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('Dade');
            $comment->setComment('Name your stakes.');
            $comment->setfigure($manager->merge($this->getReference('figure-2')));
            $comment->setCreated(new \DateTime("2011-07-23 06:18:35"));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('Kate');
            $comment->setComment('If I win, you become my slave.');
            $comment->setfigure($manager->merge($this->getReference('figure-2')));
            $comment->setCreated(new \DateTime("2011-07-23 06:22:53"));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('Dade');
            $comment->setComment('Your SLAVE?');
            $comment->setfigure($manager->merge($this->getReference('figure-2')));
            $comment->setCreated(new \DateTime("2011-07-23 06:25:15"));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('Kate');
            $comment->setComment('You wish! You\'ll do shitwork, scan, crack copyrights...');
            $comment->setfigure($manager->merge($this->getReference('figure-2')));
            $comment->setCreated(new \DateTime("2011-07-23 06:46:08"));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('Dade');
            $comment->setComment('And if I win?');
            $comment->setfigure($manager->merge($this->getReference('figure-2')));
            $comment->setCreated(new \DateTime("2011-07-23 10:22:46"));
            $manager->persist($comment);

            $comment = new Comment();
            $comment->setUser('Kate');
            $comment->setComment('Make it my first-born!');
            $comment->setfigure($manager->merge($this->getReference('figure-2')));
            $comment->setCreated(new \DateTime("2011-07-23 11:08:08"));
            $manager->persist($comment);

            $manager->flush();
    }



       public function getOrder()
        {
            return 1;
        }

      
    


       
}




?>

