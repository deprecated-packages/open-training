<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\ProvisionData;
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

        $formBuilder->add('lectorPaidAmount', TextType::class, [
            'help' => 'Lunch'
        ]);
        $formBuilder->add('organizerPaidAmount', TextType::class, [
            'help' => 'Certificates, small food'
        ]);
        $formBuilder->add('ownerPaidAmount', TextType::class);

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
