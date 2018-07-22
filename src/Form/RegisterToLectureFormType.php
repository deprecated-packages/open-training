<?php declare(strict_types=1);

namespace App\Form;

use App\Request\ProvisionFormRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class RegisterToLectureFormType extends AbstractType
{
    /**
     * @param mixed[] $options
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options): void
    {
        // who
        // name
        // email
        // discount
        // lecture
    }

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
//        $optionsResolver->setDefaults([
//            'data_class' => ProvisionFormRequest::class,
//        ]);
    }
}
