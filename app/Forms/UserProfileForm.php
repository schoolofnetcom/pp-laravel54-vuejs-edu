<?php

namespace SON\Forms;

use Kris\LaravelFormBuilder\Form;

class UserProfileForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('address', 'text', [
                'label' => 'Endereço',
                'rules' => 'required|max:255'
            ])
            ->add('cep', 'text', [
                'label' => 'CEP',
                'rules' => 'required|max:8'
            ])
            ->add('number', 'text', [
                'label' => 'Número',
                'rules' => 'required|max:255'
            ])
            ->add('complement', 'text', [
                'label' => 'Complemento',
                'rules' => 'max:255'
            ])
            ->add('city', 'text', [
                'label' => 'Cidade',
                'rules' => 'required|max:255'
            ])
            ->add('neighborhood', 'text', [
                'label' => 'Bairro',
                'rules' => 'required|max:255'
            ])
            ->add('state', 'text', [
                'label' => 'Estado',
                'rules' => 'required|max:255'
            ]);

    }
}
