<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class MigCommand extends Command
{
    protected static $defaultName = 'app:mig';

    protected function configure()
    {
        $this
        ->setName('app:mig')
        ->setDescription('Command to update db init')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Mise à jour de la BDD');
        $io->progressStart(5);
        $io->newLine(4);

        $io->section('Suppression de l\'ancienne table');
        $process = new Process('bin/console doctrine:database:drop --force');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });


        $process->wait();
        $io->newLine(20);



        $io->title('Mise à jour de la BDD');
        $io->progressAdvance();
        $io->newLine(4);

        $io->section('Création de la table');
        $process = new Process('bin/console doctrine:database:create');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });


        $process->wait();
        $io->newLine(20);



        $io->title('Mise à jour de la BDD');
        $io->progressAdvance();
        $io->newLine(4);

        $io->section('Application de la migration doctrine');
        $process = new Process('bin/console doctrine:migration:migrate');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });


        $process->wait();
        $io->newLine(20);



        $io->title('Mise à jour de la BDD');
        $io->progressAdvance();
        $io->newLine(4);

        $io->section('Application des fixtures doctrine');
        $process = new Process('bin/console alice:fixture');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });


        $process->wait();
        $io->newLine(20);

        $io->title('Mise à jour de la BDD');
        $io->progressAdvance();
        $io->newLine(4);

        $io->section('Application des fixtures alices');
        $process = new Process('bin/console doctrine:fixtures:load --append --env=dev');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });


        $process->wait();
        $io->newLine(20);

        $io->success('Base de données à jour !');
    }
}
