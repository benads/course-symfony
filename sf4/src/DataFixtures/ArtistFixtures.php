<?php
namespace App\DataFixtures;
use App\Entity\Artist;
use Doctrine\Common\Persistence\ObjectManager;

class ArtistFixtures extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {
        $artist = $this->getRandomReference('artist');
        
        // La fonction anonyme sera exécutée 50 fois
        $this->createMany(50, $artist ,function ($num) {
            // Construction du nom d'artiste
            $name = $this->faker->randomElement(['DJ ', 'MC ', 'Lil ', '']);
            $name .= $this->faker->firstName;
            $name .= $this->faker->randomElement([
                ' ' . $this->faker->realText(10),
                ' aka ' . $this->faker->domainWord,
                ' & The ' . $this->faker->lastName,
                ''
            ]);
            $artist = (new Artist())
                ->setName($name)
                ->setDescription( $this->faker->realText(10))
            ;
            // Toujours retourner l'entité
            return $artist;
        });
        // Pour terminer, enregistrer
        $manager->flush();
    }
}