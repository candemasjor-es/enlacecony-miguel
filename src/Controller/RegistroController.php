<?php

namespace App\Controller;

use App\Form\DatosRegistrarteType;
use App\Repository\DatosRegistrarteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(MailerInterface $mailer, Request $request, DatosRegistrarteRepository $repository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(DatosRegistrarteType::class);
        $form->handleRequest($request);
        
        $usuarioEncontrado = false;
        $datosRegistrarte = null;
        $registroForm = $this->createForm(DatosRegistrarteType::class); // Define $registroForm aquí

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $nombre = $data->getNombre();
            $apellidos = $data->getApellidos();
            $datosRegistrarte = $repository->findOneBy([
                'nombre' => $nombre,
                'apellidos' => $apellidos
            ]);
            if ($datosRegistrarte) {
                $registroForm = $this->createForm(DatosRegistrarteType::class);
                $registroForm->handleRequest($request);
                if (!$usuarioEncontrado && $registroForm->isSubmitted() && $registroForm->isValid()) {
                    $nuevoEmail = $data->getEmail();
                    if ($nuevoEmail !== null) {                   
                        $datosRegistrarte->setEmail($nuevoEmail);
                        $user = new User();
                        function generateRandomPassword() {
                            $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $lowercase = 'abcdefghijklmnopqrstuvwxyz';
                            $numbers = '0123456789';
                        
                            $password = $uppercase[random_int(0, strlen($uppercase) - 1)];
                        
                            for ($i = 0; $i < 7; $i++) {
                                $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
                            }
                        
                            for ($i = 0; $i < 7; $i++) {
                                $password .= $numbers[random_int(0, strlen($numbers) - 1)];
                            }
                        
                            return str_shuffle($password);
                        }
                
                        $randomPassword = generateRandomPassword();

                        $password = $userPasswordHasher->hashPassword(
                            $user,
                            $randomPassword
                        );
                        $user->setName($datosRegistrarte->getNombre());
                        $user->setSurnames($datosRegistrarte->getApellidos());
                        $user->setPhome('null');
                        $user->setRoles(array('ROLE_USER'));
                        $user->setEmail($nuevoEmail);
                        $user->setPassword($password);
                        $entityManager->persist($user);
                        $entityManager->flush();

                        $email = (new Email())
                        ->from('support@enlacecony-miguel.com')
                        ->to($nuevoEmail)
                        ->subject('¡Registro exitoso!')
                        ->html('<p>Muchas gracias por registrarte. tu correo '. $nuevoEmail .'<br> Tu contraseña es: ' . $randomPassword . '</p>');

                        $mailer->send($email);

                        return $this->redirectToRoute('app_registro_gracias', [], Response::HTTP_SEE_OTHER);

                    }
                    
                }
            } else {
                $this->addFlash('error', 'Nombre y apellidos no encontrados.');
            }
            $usuarioEncontrado = $datosRegistrarte !== null;
        }

        return $this->render('registro/index.html.twig', [
            'form' => $form->createView(),
            'registroForm' => $registroForm->createView(),
            'usuarioEncontrado' => $usuarioEncontrado,
            'datosRegistrarte' => $datosRegistrarte,
        ]);
    }

    #[Route('/registro/gracias', name: 'app_registro_gracias')]
    public function gracias(): Response
    {
        return $this->render('registro/gracias.html.twig', [
        ]);
    }
}
