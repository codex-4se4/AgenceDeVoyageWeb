<?php

namespace App\Controller;

use App\Entity\Partenariat;
use App\Form\PartenariatType;
use App\Repository\PartenariatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/partenariat")
 */
class PartenariatController extends AbstractController
{
    /**
     * @Route("/", name="partenariat_index", methods={"GET"})
     */
    public function index(PartenariatRepository $partenariatRepository): Response
    {
        return $this->render('partenariat/index.html.twig', [
            'partenariats' => $partenariatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="partenariat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $partenariat = new Partenariat();
        $form = $this->createForm(PartenariatType::class, $partenariat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($partenariat);
            $entityManager->flush();

            return $this->redirectToRoute('partenariat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partenariat/new.html.twig', [
            'partenariat' => $partenariat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partenariat_show", methods={"GET"})
     */
    public function show(Partenariat $partenariat): Response
    {
        return $this->render('partenariat/show.html.twig', [
            'partenariat' => $partenariat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="partenariat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Partenariat $partenariat): Response
    {
        $form = $this->createForm(PartenariatType::class, $partenariat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partenariat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partenariat/edit.html.twig', [
            'partenariat' => $partenariat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partenariat_delete", methods={"POST"})
     */
    public function delete(Request $request, Partenariat $partenariat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partenariat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($partenariat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('partenariat_index', [], Response::HTTP_SEE_OTHER);
    }
}
