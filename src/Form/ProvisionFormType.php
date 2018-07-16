<?php declare(strict_types=1);

namespace App\Form;

use OpenLecture\Provision\Data\ProvisionData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProvisionFormType extends AbstractType
{
    /**
     * @param mixed[] $options
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options): void
    {
        $formBuilder->add('incomeAmount', TextType::class);

        $formBuilder->add('lectorExpenses', TextType::class, [
            'help' => 'Lunch',
            'required' => false,
        ]);
        $formBuilder->add('organizerExpenses', TextType::class, [
            'help' => 'Certificates, small food',
            'required' => false,
        ]);
        $formBuilder->add('ownerExpenses', TextType::class, [
            'help' => 'Rent, Coworking space',
            'required' => false,
        ]);

        $formBuilder->add('submit', SubmitType::class, [
            'label' => 'Compute Provisions',
        ]);
    }

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefaults([
            'data_class' => ProvisionData::class,
        ]);
    }
}
