<?php

namespace App\Controller;

use App\Entity\ClassRoom;
use App\Form\AjoutType;
use App\Repository\ClassRoomRepository;
use App\Repository\ClubRepository;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    #[Route('/listeclassroom', name: 'app_classroom')]
    public function listclub(ClassRoomRepository $repository)
    {
        $clasroom=$repository->findAll();
        return $this->render("classroom/liste.html.twig",array("classroom"=>$clasroom));
    }


    #[Route('/addClassroomForm', name: 'addClassroomForm')]
    public function addClassroomForm(Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= new  ClassRoom();
        $form= $this->createForm(AjoutType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->persist($classroom);
            $em->flush();
            return  $this->redirectToRoute("addClassroomForm");
        }
        return $this->renderForm("classroom/add.html.twig",array("Formclassroom"=>$form));
    }




    #[Route('/updateclassroom/{id}', name: 'update_classroom')]
    public function updateStudentForm($id,ClassRoomRepository  $repository,Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= $repository->find($id);
        $form= $this->createForm(AjoutType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return  $this->redirectToRoute("addClassroomForm");
        }
        return $this->renderForm("classroom/update.html.twig",array("Formclassroom"=>$form));
    }

    #[Route('/removeclassroom/{id}', name: 'remove_classroom')]
    public function remove(ManagerRegistry $doctrine,$id,ClassRoomRepository $repository)
    {
        $student= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute("addClassroomForm");
    }
    #[Route('/showClassroom/{id}', name: 'showClassroom')]
    public function showClassroom(StudentRepository $repo,$id,ClassroomRepository $repository)
    {
        $classroom= $repository->find($id);
        $students= $repo->getStudentsByClassroom($id);
        return $this->render("student/showClassroom.html.twig",
            array("classroom"=>$classroom,
                "students"=>$students));
    }




}
