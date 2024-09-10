<?php

// src/Command/CreateUserCommand.php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new user.')
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        // Create and configure the new user
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        // Persist the user
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('User created successfully!');

        return Command::SUCCESS;
    }
}
