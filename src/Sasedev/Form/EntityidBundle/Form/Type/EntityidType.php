<?php

namespace Sasedev\Form\EntityidBundle\Form\Type;

use Sasedev\Form\EntityidBundle\DataTransformer\EntityToIdTransformer;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *
 * @author sasedev <seif.salah@gmail.com>
 */
class EntityidType extends AbstractType
{

	/**
	 *
	 * @var RegistryInterface $registry
	 */
	protected $registry;

	/**
	 *
	 * @param RegistryInterface $registry
	 */
	public function __construct(RegistryInterface $registry)
	{
		$this->registry = $registry;
	}

	/**
	 *
	 * {@inheritDoc} @see AbstractType::buildForm()
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$em = $this->registry->getManager($options['em']);

		$builder->addModelTransformer(
			new EntityToIdTransformer($em, $options['class'], $options['choice_label'], $options['query_builder'], $options['multiple']));
	}

	/**
	 *
	 * {@inheritDoc} @see AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setRequired(array('class'));
		$resolver->setDefaults(array('em' => null, 'choice_label' => null, 'query_builder' => null, 'hidden' => true, 'multiple' => false));
	}

	/**
	 *
	 * {@inheritDoc} @see AbstractType::buildView()
	 */
	public function buildView(FormView $view, FormInterface $form, array $options)
	{
		if (true === $options['hidden']) {
			$view->vars['type'] = HiddenType::class;
		}
	}

	/**
	 *
	 * {@inheritDoc} @see AbstractType::getParent()
	 */
	public function getParent()
	{
		return TextType::class;
	}

	/**
	 *
	 * {@inheritDoc} @seeAbstractType::getName()
	 */
	public function getName()
	{
		return 'entityid';
	}

	/**
	 *
	 * {@inheritDoc} @seeAbstractType::getBlockPrefix()
	 */
	public function getBlockPrefix()
	{
		return $this->getName();
	}
}
