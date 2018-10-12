<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AliceFixturesCommand extends Command
{
    protected static $defaultName = 'alice:fixtures';

    private $manager;

    public function __construct( EntityManagerInterface $manager, ?string $name = null )
    {
        parent::__construct($name);
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setDescription('execute fixtures made by nemio/alice package -> generate fake data')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $loader = new NativeLoader();
        $loader->getFakerGenerator()->seed(1234);
        $objectSet = $loader->loadFile( 'src/DataFixtures/aliceFixtures.yaml');

        foreach ( $objectSet->getObjects() as $object ) {
//            var_dump($object);
            $this->manager->persist( $object );
        }

        $this->manager->flush();

        $io->success('Les données sont maintenant en base de données');
    }
}
