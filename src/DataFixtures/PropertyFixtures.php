<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PropertyFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * PropertyFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $heat = ["Gaz", "Electrique", "fuel"];

        for ($i=0; $i <= 30 ; $i++) { 
            $property = new Property();
            $property->setTitle($faker->word())
                ->setDescription($faker->text(200))
                ->setSurface($faker->randomDigit())
                ->setRooms($faker->randomDigit())
                ->setBedrooms($faker->randomDigit())
                ->setFloor($faker->numberBetween(0,4))
                ->setHeat($faker->randomElement($heat))
                ->setPrice($faker->numberBetween(100000, 800000))
                ->setCity($faker->city())
                ->setAddress($faker->address())
                ->setZipcode($faker->postcode())
                ->setCreatedAt($faker->dateTime('now'));

            $manager->persist($property);
        }

        $user = new User();
        $user->setUsername('demo')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'demo'))
    ;
        $manager->persist($user);
        $manager->flush();
    }
}
