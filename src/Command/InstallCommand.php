<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class InstallCommand extends Command
{
    protected static $defaultName = 'app:install';

    protected function configure()
    {
        $this
            ->setName('app:install')
            ->setDescription('Command to install the project')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('    Installation of the project');
        $io->progressStart(10);
        $io->newLine(4);

        $io->section('Installation of composer dependencies');
        $process = new Process('composer i');
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->title('    Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);

        $io->section('Installation of the doctrine dependencies');
        $process = new Process('composer require --dev doctrine/doctrine-fixtures-bundle');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->title('    Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);

        $io->section('Installation of CURL');
        $process = new Process('sudo apt-get install curl');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->title('    Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);

        $io->section('Installation of NodeJS 1/2');
        $process = new Process('curl -sL https://deb.nodesource.com/setup_10.x | sudo bash -');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->title('    Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);

        $io->section('Installation of NodeJS 2/2');
        $process = new Process('sudo apt-get install nodejs');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->section('Installation of NodeJS dependencies');
        $process = new Process('npm i');
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->section('Launch MySQL server');
        $process = new Process('sudo service mysql start');
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->section('Create DataBase');
        $process = new Process('bin/console doctrine:database:create');
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->section('Init DataBase');
        $process = new Process('bin/console doctrine:migration:migrate');
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });

        $io->newLine(100);

        $io->section('Run the server');
        $process = new Process('php bin/console server:start');
        $process->run(function ($type, $buffer) use ($io, $output)
        {
            $output->writeln('> ' . $buffer);
        });


        $io->progressFinish();
        $io->newLine(2);
        $io->success('Yeah ! The project is installed ! You can check it out in your favourite web browser :D');
    }
}
