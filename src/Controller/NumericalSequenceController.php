<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\NumericalSequenceType;
use App\Service\ConvertDataFromForm;
use App\Service\NumericalSequence;
use App\Utils\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NumericalSequenceController extends AbstractController
{
    /**
     * @var ConvertDataFromForm
     */
    private $convertDataFromForm;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var NumericalSequence
     */
    private $numericalSequence;

    public function __construct(ConvertDataFromForm $convertDataFromForm, Validator $validator, NumericalSequence $numericalSequence)
    {
        $this->convertDataFromForm = $convertDataFromForm;
        $this->validator = $validator;
        $this->numericalSequence = $numericalSequence;
    }

    /**
     * @Route("/form", name="form")
     */
    public function view(Request $request)
    {
        $form = $this->createForm(NumericalSequenceType::class)->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();
            $numbers = $this->convertDataFromForm->getDataToArray($data['number']);

            foreach ($numbers as $number) {
                $this->validator->validateInputNumber($number);
                $results[$number] = $this->numericalSequence->getMaximumValue($number);
            }

            return $this->render('numerical-sequence/result.html.twig', [
                'results' => $results
            ]);
        }

        return $this->render('numerical-sequence/view.html.twig', [
            'form' => $form->createView()
        ]);
    }
}