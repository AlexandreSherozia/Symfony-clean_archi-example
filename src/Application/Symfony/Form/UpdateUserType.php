<?php

namespace App\Application\Symfony\Form;

use App\Domain\User\UseCase\Edit\UpdateUserRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('isPosted',HiddenType::class, ['data'=>true])
			->add('email', EmailType::class,['required'=>true])
			->add('firstName',null,['required'=>true])
			->add('lastName',null,['required'=>true])
			->add('save', SubmitType::class)
		;
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults(
			[
				'data_class' => UpdateUserRequest::class,
				'csrf_protection' => false,
			]
		);
	}
}