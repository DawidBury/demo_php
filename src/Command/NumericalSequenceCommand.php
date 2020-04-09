<?php declare(strict_types=1);

namespace App\Command;

use App\Service\NumericalSequence;
use App\Utils\Validator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class NumericalSequenceCommand extends Command
{
    protected static $defaultName = 'app:numerical-sequence';

    /**
     * @var NumericalSequence
     */
    private $numericalSequence;

    /**
     * @var Validator
     */
    private $validator;

    public function __construct(NumericalSequence $numericalSequence, Validator $validator)
    {
        $this->numericalSequence = $numericalSequence;
        $this->validator = $validator;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Calculates a numeric sequence with the designation A002487')
            ->addArgument('number', InputArgument::OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question("Podaj liczbę 'n': ");

        $output->writeln('Witam! Podaj mi proszę liczby do policzenia największej liczby ciągu :)');
        $output->writeln('PORADNIK: Aby zakończyć wpisywanie liczb wpisz q');

        $numbers = [];
        do {
            $number = $helper->ask($input, $output, $question);
            $this->validator->validateInputNumber($number);
            $numbers[] = $number;
        } while ($number != 'q');
    }
}