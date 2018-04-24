<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\DataFixtures\ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use ST\PlatformBundle\Entity\Figure;
use ST\PlatformBundle\Entity\Comment;
use ST\PlatformBundle\Entity\Image;
use ST\PlatformBundle\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
* Tricks Fixtures
*/
class AppFixture extends AbstractFixture implements OrderedFixtureInterface
{

    /**
    * Load
    *
    * @param manager $manager
    */
    public function load(ObjectManager $manager)
    {
        // FIGURE 1
        $video1 = new Video();
        $video1->setUrl('https://www.youtube.com/watch?v=URFnYGzu9lU');
        $manager->persist($video1);

        $src1  = __DIR__.'/../../../../../web/uploads/fix/1.jpg';
        $file1 = new UploadedFile(
            $src1,
            '1.jpg',
            '',
            filesize($src1),
            null,
            true
        );

        $image1 = new Image();
        $image1->setFile($file1);
        $manager->persist($image1);

        $figure1 = new Figure();
        $figure1->setNom('Backside Triple Cork 1440');
        $figure1->setDescription('En langage snowboard, un cork est une rotation horizontale plus ou moins désaxée, selon un mouvement d\'épaules effectué juste au moment du saut. Le tout premier Triple Cork a été plaqué par Mark McMorris en 2011, lequel a récidivé lors des Winter X Games 2012... avant de se faire voler la vedette par Torstein Horgmo, lors de ce même championnat. Le Norvégien réalisa son propre Backside Triple Cork 1440 et obtint la note parfaite de 50/50.');
        $figure1->setGroupe('Extreme');
        $figure1->addImage($image1);
        $figure1->addVideo($video1);
        $this->addReference('figure-1', $figure1);
        $manager->persist($figure1);

        // FIGURE 2
        $video2 = new Video();
        $video2->setUrl('https://www.youtube.com/watch?v=YQIvm_2ay-U');
        $manager->persist($video2);

        $src2   = __DIR__.'/../../../../../web/uploads/fix/2.jpg';
        $file2  = new UploadedFile(
            $src2,
            '2.jpg',
            '',
            filesize($src2),
            null,
            true
        );
        $image2 = new Image();
        $image2->setFile($file2);
        $manager->persist($image2);

        $src3   = __DIR__.'/../../../../../web/uploads/fix/3.jpg';
        $file3  = new UploadedFile(
            $src3,
            '3.jpg',
            '',
            filesize($src3),
            null,
            true
        );
        $image3 = new Image();
        $image3->setFile($file3);
        $manager->persist($image3);

        $figure2 = new Figure();
        $figure2->setNom('Double Mc Twist 1260');
        $figure2->setDescription('Le Mc Twist est un flip (rotation verticale) agrémenté d\'une vrille. Un saut très périlleux réservé aux professionnels. Le champion précoce Shaun White s\'est illustré par un Double Mc Twist 1260 lors de sa session de Half-Pipe aux Jeux Olympiques de Vancouver en 2010. Nul doute que c\'est cette figure qui lui a valu de remporter la médaille d\'or.');
        $figure2->setGroupe('Extreme');
        $figure2->addImage($image2);
        $figure2->addImage($image3);
        $figure2->addVideo($video2);
        $this->addReference('figure-2', $figure2);
        $manager->persist($figure2);

        // FIGURE 3
        $video3 = new Video();
        $video3->setUrl('https://www.youtube.com/watch?v=_2xJr3ylulQ');
        $manager->persist($video3);

        $video4 = new Video();
        $video4->setUrl('https://www.youtube.com/watch?v=hDSc7hQ0bzg');
        $manager->persist($video4);

        $src4  = __DIR__.'/../../../../../web/uploads/fix/4.jpg';
        $file4 = new UploadedFile(
            $src4,
            '4.jpg',
            '',
            filesize($src4),
            null,
            true
        );

        $image4 = new Image();
        $image4->setFile($file4);
        $manager->persist($image4);

        $figure3 = new Figure();
        $figure3->setNom('Double Backside Rodeo 1080');
        $figure3->setDescription('À l\'instar du cork, le rodeo est une rotation désaxée, qui se reconnaît par son aspect vrillé. Un des plus beaux de l\'histoire est sans aucun doute le Double Backside Rodeo 1080 effectué pour la première fois en compétition par le jeune prodige Travis Rice, lors du Icer Air 2007. La pirouette est tellement culte qu\'elle a fini dans un jeu vidéo où Travis Rice est l\'un des personnages.');
        $figure3->setGroupe('Extreme');
        $figure3->addImage($image4);
        $figure3->addVideo($video3);
        $figure3->addVideo($video4);
        $this->addReference('figure-3', $figure3);
        $manager->persist($figure3);

        // FIGURE 4
        $video5 = new Video();
        $video5->setUrl('https://www.youtube.com/watch?v=BDpxekjUCqw');
        $manager->persist($video5);

        $src5   = __DIR__.'/../../../../../web/uploads/fix/5.jpg';
        $file5  = new UploadedFile(
            $src5,
            '5.jpg',
            '',
            filesize($src5),
            null,
            true
        );
        $image5 = new Image();
        $image5->setFile($file5);
        $manager->persist($image5);

        $src6   = __DIR__.'/../../../../../web/uploads/fix/6.png';
        $file6  = new UploadedFile(
            $src6,
            '6.png',
            '',
            filesize($src6),
            null,
            true
        );
        $image6 = new Image();
        $image6->setFile($file6);
        $manager->persist($image6);

        $src7   = __DIR__.'/../../../../../web/uploads/fix/7.jpg';
        $file7  = new UploadedFile(
            $src7,
            '7.jpg',
            '',
            filesize($src7),
            null,
            true
        );
        $image7 = new Image();
        $image7->setFile($file7);
        $manager->persist($image7);

        $figure4 = new Figure();
        $figure4->setNom('Ollie');
        $figure4->setDescription(
            'Le Ollie est une impulsion  avec déformation de la planche qui permet de faire un saut, comme un ollie de skate, mais en beaucoup plus facile car les deux pieds sont attachés sur la board.

Conseils pour réaliser à un ollie en snowboard.
Le Ollie peut se décomposer en plusieurs phases :

1. La phase d\’approche consiste à avoir sa planche la plus à plat possible ou légèrement sur la carre; le regard pointé vers le spot (l\’endroit où on veut décoller). Les jambes sont fléchies, prêtes à donner une impulsion.

2. Pour déclencher le Ollie, il faut tirer sur la jambe avant tout en appuyant sur la jambe arrière pour déformer la planche et aller chercher le pop de son snowboard (le «rebond» de la planche). On peut s\'aider des bras en les dépliants comme un oiseau qui cherche à s\'envoler ;)

3. Dés que l\’on sent qu\’on décolle, il faut regrouper les jambes et les bras pour gagner en stabilité, le regard cherche déjà l\’endroit où on va aller atterrir tout en essayant de profiter du moment présent…

4.  Pour atterrir, il faut légèrement détendre les jambes pour aller chercher le sol tout en préparant l\’amorti, c\’est à dire forcer sur les jambes qui servent d\’amortisseur. Bien plier les genoux sans se laisser assoir par la force de gravité.

Le mieux c\’est de commencer à s\’entrainer à faire des ollies à plat sur la piste, puis en profitant des petits reliefs de bord de piste. Quand on se sent vraiment  à l\’aise, on peut commencer à essayer sur de plus gros sauts (kickers de snowpark par exemple). Ne pas hésiter à être créatif, repérer toute variation de terrain qui peut être un bon spot pour envoyer un ollie, et transformer la montagne en terrain de jeu…'
        );
        $figure4->setGroupe('Facile');
        $figure4->addImage($image5);
        $figure4->addImage($image6);
        $figure4->addImage($image7);
        $figure4->addVideo($video5);
        $this->addReference('figure-4', $figure4);
        $manager->persist($figure4);

        // FIGURE 5
        $video6 = new Video();
        $video6->setUrl('https://www.youtube.com/watch?v=IrTjjLUc0jU');
        $manager->persist($video6);

        $src8  = __DIR__.'/../../../../../web/uploads/fix/8.jpg';
        $file8 = new UploadedFile(
            $src8,
            '8.jpg',
            '',
            filesize($src8),
            null,
            true
        );

        $image8 = new Image();
        $image8->setFile($file8);
        $manager->persist($image8);

        $figure5 = new Figure();
        $figure5->setNom('Backside 180');
        $figure5->setDescription('Pour les néophytes, le backside 180 ou 180 back est un saut avec un demi tour qui s\'effectue côté pointes de pieds en envoyant les épaules dos à la pente lors de la rotation, ce qui fait qu\'à l’atterrissage on se retrouve en marche arrière. Comme dans toute rotation l\’important est la synchronisation entre l’impulsion et la rotation des épaules.');
        $figure5->setGroupe('Moyenne');
        $figure5->addImage($image8);
        $figure5->addVideo($video6);
        $this->addReference('figure-5', $figure5);
        $manager->persist($figure5);

        // FIGURE 6
        $video7 = new Video();
        $video7->setUrl('https://www.youtube.com/watch?v=SFYYzy0UF-8');
        $manager->persist($video7);

        $src9  = __DIR__.'/../../../../../web/uploads/fix/9.jpg';
        $file9 = new UploadedFile(
            $src9,
            '9.jpg',
            '',
            filesize($src9),
            null,
            true
        );

        $image9 = new Image();
        $image9->setFile($file9);
        $manager->persist($image9);

        $figure6 = new Figure();
        $figure6->setNom('Shred');
        $figure6->setDescription(
            'Ce qui est bien c’est qu’avec le shred,  c\'est qu\'on n\'a pas besoin de prendre trop de vitesse pour exécuter un trick et s’amuser, ça rend toujours une piste banale beaucoup plus fun sans prendre trop de risques.

Pour commencer et vraiment progresser en shred,  le mieux est de rider une petite board bien souple qui va se plier facilement et va permettre  d’apprendre et de progresser sur des tricks plus facilement avec plus de tolérance, spécialement avec les boards qui sont bien souples en torsion. Si on est à l’aise et que l’on sait bien plier sa board, on peut aussi faire tout ça avec une board plus ferme et performante, ça sera toujours plus polyvalent...'
        );
        $figure6->setGroupe('Moyenne');
        $figure6->addImage($image9);
        $figure6->addVideo($video7);
        $this->addReference('figure-6', $figure6);
        $manager->persist($figure6);

        $manager->flush();
    }//end load()

    /**
    * getOrder
    *
    * @return 1
    */
    public function getOrder()
    {
         return 1;
    }//end getOrder()
}//end class
