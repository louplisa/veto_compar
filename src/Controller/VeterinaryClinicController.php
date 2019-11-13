<?php

namespace App\Controller;

use App\Entity\VeterinaryClinic;
use App\Entity\VeterinaryClinicSearch;
use App\Form\VeterinaryClinicSearchType;
use App\Form\VeterinaryClinicType;
use App\Repository\VeterinaryClinicRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/veterinary/clinic")
 */
class VeterinaryClinicController extends AbstractController
{
    /**
     * @var VeterinaryClinicRepository
     */
    private $repository;

    public function __construct(VeterinaryClinicRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/", name="veterinary_clinic_index", methods={"GET"})
     */
    public function index(VeterinaryClinicRepository $veterinaryClinicRepository): Response
    {
        return $this->render('veterinary_clinic/index.html.twig', [
            'veterinary_clinics' => $veterinaryClinicRepository->findAll(),
        ]);
    }

    /**
     * @Route("/search", name="veterinary_clinic_search")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function clinicSearch(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new VeterinaryClinicSearch();
        $form = $this->createForm(VeterinaryClinicSearchType::class, $search);
        $form->handleRequest($request);

        $clinics = $paginator->paginate(
            $this->repository->findClinicsByLocation($search),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('veterinary_clinic/search.html.twig', [
            'current_menu' => 'clinics',
            'clinics' => $clinics,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/new", name="veterinary_clinic_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $veterinaryClinic = new VeterinaryClinic();
        $form = $this->createForm(VeterinaryClinicType::class, $veterinaryClinic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($veterinaryClinic);
            $entityManager->flush();

            return $this->redirectToRoute('veterinary_clinic_index');
        }

        return $this->render('veterinary_clinic/new.html.twig', [
            'veterinary_clinic' => $veterinaryClinic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="veterinary_clinic_show", methods={"GET"})
     */
    public function show(VeterinaryClinic $veterinaryClinic): Response
    {
        return $this->render('veterinary_clinic/show.html.twig', [
            'veterinary_clinic' => $veterinaryClinic,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="veterinary_clinic_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, VeterinaryClinic $veterinaryClinic): Response
    {
        $form = $this->createForm(VeterinaryClinicType::class, $veterinaryClinic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('veterinary_clinic_index');
        }

        return $this->render('veterinary_clinic/edit.html.twig', [
            'veterinary_clinic' => $veterinaryClinic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="veterinary_clinic_delete", methods={"DELETE"})
     */
    public function delete(Request $request, VeterinaryClinic $veterinaryClinic): Response
    {
        if ($this->isCsrfTokenValid('delete' . $veterinaryClinic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($veterinaryClinic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('veterinary_clinic_index');
    }
}
