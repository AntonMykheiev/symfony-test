<?php

namespace App\Controller;

use App\Entity\TimezoneInfo;
use App\Form\TimeZoneInfoType;
use App\Service\TimeZoneInfoService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TimeZoneInfoController
 * @package App\Controller
 */
class TimeZoneInfoController extends AbstractController
{
    /**
     * @var TimeZoneInfoService
     */
    private $timeZoneService;

    /**
     * TimeZoneInfoController constructor.
     * @param TimeZoneInfoService $timeZoneInfoService
     */
    public function __construct(
       TimeZoneInfoService $timeZoneInfoService
    ) {
        $this->timeZoneService = $timeZoneInfoService;
    }

    /**
     * @Route("/timezone", name="new_timezone", methods={"GET", "POST"})
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function timezone(Request $request)
    {
        $timeZoneInfo = new TimezoneInfo();
        $form = $this->createForm(TimeZoneInfoType::class, $timeZoneInfo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $timeZoneInfo = $this->timeZoneService->getTimeZoneInfo($form->getData());

            return $this->render('timezone.html.twig', [
                'form' => $form->createView(),
                'timezone_info' => $timeZoneInfo,
            ]);
        }

        return $this->render('timezone.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}