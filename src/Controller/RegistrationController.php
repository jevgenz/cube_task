<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
	/**
	 * @Route("/register", name="app_register")
	 * @param Request $request
	 * @param UserPasswordEncoderInterface $passwordEncoder
	 * @return Response
	 */
	public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
	{
		$user = new User();
		$form = $this->createForm(RegistrationFormType::class, $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// encode the plain password
			$user->setPassword(
				$passwordEncoder->encodePassword(
					$user,
					$form->get('password')->getData()
				)
			);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($user);
			$entityManager->flush();

			// do anything else you need here, like send an email

			return $this->redirectToRoute('login');
		}

		return $this->render('registration/register.html.twig', [
			'registrationForm' => $form->createView(),
		]);
	}

	/**
	 * @Route("/email_available", name="email_available")
	 * @param Request $request
	 * @param EntityManagerInterface $entityManager
	 * @return Response
	 */
	public function checkEmailAvailable(Request $request, EntityManagerInterface $entityManager): Response
	{
		if ($request->isMethod('POST')) {
			$email = $request->request->get('email');
			if (!$entityManager->getRepository(User::class)->findOneBy(['email' => $email])) {
				return $this->json('', 200);
			};
		}

		return $this->json('There is already an account with this email', 200);
	}

	/**
	 * @Route("/confirm", name="email_confirmation")
	 * @throws \PHPMailer\PHPMailer\Exception
	 */
	public function sendConfirmEmail()
	{
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = $_ENV['SMTP_MAIL_HOST'];
		$mail->Username = $_ENV['SMTP_MAIL_USER'];
		$mail->Password = $_ENV['SMTP_MAIL_PASS'];
		$mail->Port = $_ENV['SMTP_MAIL_PORT'];
		$mail->SMTPSecure = 'tls';
		$mail->SMTPDebug = 0;

		$mail->setFrom('special_cases@inbox.lv');
		$mail->addAddress('special_cases@inbox.lv');

		$mail->Subject = "confirmation";
		$mail->isHTML(true);
		$mail->Body = $this->renderView(
			'emails/registration.html.twig'
		);

		$mail->send();

		return $this->render(
			'emails/registration.html.twig');
	}
}
