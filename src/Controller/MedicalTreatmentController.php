<?php

namespace App\Controller;

use App\Entity\MedicalTreatment;
use App\Form\MedicalTreatmentType;
use App\Repository\MedicalTreatmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medical/treatment")
 */
class MedicalTreatmentController extends AbstractController
{
    /**
     * @Route("/", name="medical_treatment_index", methods={"GET"})
     */
    public function index(MedicalTreatmentRepository $medicalTreatmentRepository): Response
    {
        return $this->render('medical_treatment/index.html.twig', [
            'medical_treatments' => $medicalTreatmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="medical_treatment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medicalTreatment = new MedicalTreatment();
        $form = $this->createForm(MedicalTreatmentType::class, $medicalTreatment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicalTreatment);
            $entityManager->flush();

            return $this->redirectToRoute('medical_treatment_index');
        }

        return $this->render('medical_treatment/new.html.twig', [
            'medical_treatment' => $medicalTreatment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medical_treatment_show", methods={"GET"})
     */
    public function show(MedicalTreatment $medicalTreatment): Response
    {
        return $this->render('medical_treatment/show.html.twig', [
            'medical_treatment' => $medicalTreatment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medical_treatment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MedicalTreatment $medicalTreatment): Response
    {
        $form = $this->createForm(MedicalTreatmentType::class, $medicalTreatment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medical_treatment_index');
        }

        return $this->render('medical_treatment/edit.html.twig', [
            'medical_treatment' => $medicalTreatment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medical_treatment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MedicalTreatment $medicalTreatment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicalTreatment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medicalTreatment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medical_treatment_index');
    }
}
