<?php

namespace  Fmb\Entrypoint\Command;

use Fmb\App\Domain\Entity\Enum\RolesEnum;
use Fmb\Infra\Database\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-admin-user',
    description: 'Add a short description for your command',
)]
class CreateAdminUserCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $adminEmail = 'admin@example.com';
        $name = 'Admin';
        $existingAdmin = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $adminEmail]);

        if ($existingAdmin) {
            $output->writeln('<comment>Admin user already exists!</comment>');
            return Command::SUCCESS;
        }

        $adminUser = new User();
        $adminUser->setName($name);
        $adminUser->setEmail($adminEmail);
        $adminUser->setRoles([RolesEnum::ADMIN->value]);
        $adminUser->setPassword('$2y$13$lPQC7NVAMGmWbGdvsDQRauAEwErcAcCrzg2R/vHTKowQ1Zf7Ax3BO');

        $this->entityManager->persist($adminUser);
        $this->entityManager->flush();

        $output->writeln('<info>Admin user created successfully!</info>');

        return Command::SUCCESS;
    }
}
