<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }


    #[Route('/add/{var}', name: 'app_pizza')]

    public function addpizza($var){
        return new Response("pizza".$var);
    }




    #[Route('/list', name: 'app_pizza')]
    public function list(){
        return $this->render('student/liste.html.twig');
    }


    #[Route('/student', name: 'app_student')]
    public function lists(StudentRepository $repository){
        $students=$repository->findAll();
        $student=$repository->sortbycin();
        $topStudent=$repository->topStudent();

        return $this->render('student/lists.html.twig',array('student'=>$students,'students'=>$student,'topStudent'=>$topStudent));
    }

    #[Route('/addStudentForm', name: 'addStudentForm')]
    public function addClassroomForm(Request  $request,ManagerRegistry $doctrine,StudentRepository $repository)
    {
        $student= new  Student();
        $form= $this->createForm(StudentType::class,$student);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->persist($student);
            $em->flush();
            return  $this->redirectToRoute("addStudentForm");
        }
        return $this->renderForm("student/add.html.twig",array("Formstudent"=>$form));
    }




}
