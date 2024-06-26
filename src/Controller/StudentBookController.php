<?php

namespace App\Controller;

use App\Entity\StudentBook;
use App\Form\StudentBookType;
use App\Repository\StudentBookRepository;
use App\Services\ManageFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/student/book')]
class StudentBookController extends AbstractController
{
    private $manageFile;

    public function __construct(ManageFile $manageFile) {
        $this->manageFile = $manageFile;
    }
    #[Route('/', name: 'app_student_book_index', methods: ['GET'])]
    public function index(StudentBookRepository $studentBookRepository): Response
    {
        return $this->render('student_book/index.html.twig', [
            'student_books' => $studentBookRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_student_book_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $studentBook = new StudentBook();
        $form = $this->createForm(StudentBookType::class, $studentBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form["pdfFile"]->getData();

            $file_url = $this->manageFile->savePdf($file);
            $studentBook->setFileUrl($file_url);

            $entityManager->persist($studentBook);
            $entityManager->flush();

            return $this->redirectToRoute('app_student_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('student_book/new.html.twig', [
            'student_book' => $studentBook,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_student_book_show', methods: ['GET'])]
    public function show(StudentBook $studentBook): Response
    {
        return $this->render('student_book/show.html.twig', [
            'student_book' => $studentBook,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_student_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StudentBook $studentBook, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StudentBookType::class, $studentBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_student_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('student_book/edit.html.twig', [
            'student_book' => $studentBook,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_student_book_delete', methods: ['POST'])]
    public function delete(Request $request, StudentBook $studentBook, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$studentBook->getId(), $request->request->get('_token'))) {
            $pdfUrl = $studentBook->getFileUrl();
            $this->manageFile->removeFile($pdfUrl);

            $entityManager->remove($studentBook);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_student_book_index', [], Response::HTTP_SEE_OTHER);
    }
}
