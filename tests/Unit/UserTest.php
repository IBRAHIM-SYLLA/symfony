<?php

namespace App\Tests\Unit;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testEntityUserIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $user = new User;
        $user->setEmail('ibrahim@laplateforme.io')
            ->setPassword('Test123*')
            ->setFirstname('Ibrahim')
            ->setLastname('SYLLA');

        $errors = $container->get('validator')->validate($user);

        $this->assertCount(0, $errors);

        // $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }

    public function testInvalidFirstname()
    {
        self::bootKernel();
        $container = static::getContainer();

        $user = new User;
        $user->setEmail('ibrahim@laplateforme.io')
            ->setPassword('Test123*')
            ->setFirstname('')
            ->setLastname('SYLLA');

        $errors = $container->get('validator')->validate($user);

        $this->assertCount(1, $errors);
    }
}
