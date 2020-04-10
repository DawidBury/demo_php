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

    /**
     * @var array
     */
    private $numbers = [];

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

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question("Podaj liczbę 'n': ");
        $counter = 0;
        $maxNumberOfNumbers = 10;

        $output->writeln('Witam! Podaj mi proszę liczby do policzenia największej liczby ciągu :)');
        $output->writeln('PORADNIK: Aby zakończyć wpisywanie liczb wpisz q');

        do {
            $number = $helper->ask($input, $output, $question);

            if ($number === 'q')
                return;

            $this->validator->validateInputNumber($number);
            $this->numbers[] = $number;

            $counter++;
        } while ($counter != $maxNumberOfNumbers);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->numbers as $number) {
            $result = $this->numericalSequence->getMaximumValue($number);
            $output->writeln('Input: ' . $number . ' | output: ' . $result);
        }
    }
}