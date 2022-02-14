<?php

namespace App\Controller;

use App\Factory\CalculationFactory;
use App\Helpers\CalculationHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CalculationController extends AbstractController
{
    /**
     * @return Response
     *
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('calculation/index.html.twig');
    }

    /**
     * @param Request $request
     * @param CalculationHelper $helper
     * @param CalculationFactory $factory
     * @return Response
     *
     * @Route("/calculatrice", name="calculation")
     */
    public function calculation(Request $request, CalculationHelper $helper, CalculationFactory $factory): Response
    {
        $calculation = $factory->create();
        $calculation->setOperation($request->getContent());
        try {
            $result = $helper->calculation($calculation->getOperation());
            return $this->json([
               'result' => $result,
            ]);
        } catch (\Exception $exception) {
            //error
            return throw new Exception($exception->getMessage());
        }
    }
}