<?php

namespace App\Controller;

use App\Entity\Dispense;
use App\Entity\DispenseSearch;
use App\Form\DispenseSearchType;
use App\Form\DispenseType;
use App\Repository\DispenseRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dispense")
 */
class DispenseController extends AbstractController
{
    /**
     * @var DispenseRepository
     */
    private $repository;

    public function __construct(DispenseRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/", name="dispense_index", methods={"GET"})
     */
    public function index(DispenseRepository $dispenseRepository): Response
    {
        return $this->render('dispense/index.html.twig', [
            'dispenses' => $dispenseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/search", name="dispense_search")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function dispenseSearch(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new DispenseSearch();
        $form = $this->createForm(DispenseSearchType::class, $search);
        $form->handleRequest($request);

        $dispenses = $paginator->paginate(
            $this->repository->findPriceByTreatment($search),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('dispense/search.html.twig', [
            'current_menu' => 'dispenses',
            'dispenses' => $dispenses,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="dispense_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dispense = new Dispense();
        $form = $this->createForm(DispenseType::class, $dispense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dispense);
            $entityManager->flush();

            return $this->redirectToRoute('dispense_index');
        }

        return $this->render('dispense/new.html.twig', [
            'dispense' => $dispense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dispense_show", methods={"GET"})
     */
    public function show(Dispense $dispense): Response
    {
        return $this->render('dispense/show.html.twig', [
            'dispense' => $dispense,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dispense_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dispense $dispense): Response
    {
        $form = $this->createForm(DispenseType::class, $dispense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dispense_index');
        }

        return $this->render('dispense/edit.html.twig', [
            'dispense' => $dispense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dispense_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dispense $dispense): Response
    {
        if ($this->isCsrfTokenValid('delete' . $dispense->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dispense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dispense_index');
    }
}
