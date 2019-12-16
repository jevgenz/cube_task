<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('first_name', TextType::class, [
				'attr' => [
					'placeholder' => 'First Name',
					'class' => 'form-control input-sm'
				],
				'constraints' => [
					new NotBlank([
						'message' => 'Please enter a name',
					]),
					new Length([
						'min' => 1,
						'minMessage' => 'Your name should be at least 1 characters',
						'max' => 255,
					]),
				],
			])
			->add('last_name', TextType::class, [
				'attr' => [
					'placeholder' => 'Last Name',
					'class' => 'form-control input-sm'
				],
				'constraints' => [
					new NotBlank([
						'message' => 'Please enter a surname',
					]),
					new Length([
						'min' => 1,
						'minMessage' => 'Your name should be at least 1 characters',
						'max' => 255,
					]),
				],
			])
			->add('email', EmailType::class, [
				'attr' => [
					'placeholder' => 'Email',
					'class' => 'form-control input-sm'
				],
			])
			->add('password', PasswordType::class, [
				'attr' => [
					'placeholder' => 'Password',
					'class' => 'form-control input-sm'
				],
				// instead of being set onto the object directly,
				// this is read and encoded in the controller
				'mapped' => false,
				'constraints' => [
					new NotBlank([
						'message' => 'Please enter a password',
					]),
					new Length([
						'min' => 6,
						'minMessage' => 'Your password should be at least {{ limit }} characters',
						// max length allowed by Symfony for security reasons
						'max' => 4096,
					]),
				],
			])
			->add('Register', SubmitType::class, [
				'attr' => [
					'placeholder' => 'Register',
					'class' => 'btn btn-info btn-block'
				],
			])
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => User::class,
		]);
	}
}
