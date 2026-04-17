<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // ===== USERS =====
       $users = [];

for ($i = 1; $i <= 5; $i++) {
    $user = new User();

    $user->setEmail($faker->unique()->email());
    $user->setFirstName($faker->firstName());
    $user->setLastName($faker->lastName());
    $user->setCreatedAt(new \DateTimeImmutable());

    // ADMIN + USERS
    if ($i === 1) {
        $user->setRoles(['ROLE_ADMIN']);
    } else {
        $user->setRoles(['ROLE_USER']);
    }

    $password = $this->hasher->hashPassword($user, 'password');
    $user->setPassword($password);

    $manager->persist($user);
    $users[] = $user;
}
        // ===== CATEGORIES =====
        $categories = [];

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();

            $category->setName($faker->word());
            $category->setDescription($faker->sentence());

            $manager->persist($category);
            $categories[] = $category;
        }

        // ===== POSTS =====
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();

            $post->setTitle($faker->sentence(3));
            $post->setContent($faker->paragraph(5));
           $post->setPublishedAt(
    \DateTimeImmutable::createFromMutable($faker->dateTime())
);
           $post->setPicture('default.jpg');

            // relation aléatoire
            $post->setCategory($faker->randomElement($categories));
            $post->setUser($faker->randomElement($users)); // si relation existe

            $manager->persist($post);
        }

        $manager->flush();
    }
}