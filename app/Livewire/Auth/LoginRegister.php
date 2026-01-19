<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Acesso ao Sistema')]
class LoginRegister extends Component
{
    public $isRegisterMode = false;

    public $role = 'customer';

    public $document = '';

    // Propriedades do Formulário
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = ''; // Necessário para a validação confirmed

    public $cpf = '';

    public function toggleMode()
    {
        $this->isRegisterMode = ! $this->isRegisterMode;
        // Limpa os campos ao trocar entre Login e Cadastro
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'cpf', 'document']);
        $this->resetValidation();
    }

    public function login()
    {
        $credentials = $this->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            // AJUSTE: Redireciona para a Home (Loja) em vez do Dashboard
            return $this->redirect('/', navigate: true);
        }

        $this->addError('email', 'E-mail ou senha inválidos.');
    }

    public function register()
    {
        // Validação condicional
        $rules = [
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:customer,seller', // Segurança contra injeção de admin
        ];

        // Se for vendedor, valida documento (CNPJ/CPF). Se cliente, valida CPF.
        if ($this->role === 'seller') {
            $rules['document'] = 'required|min:11|max:18';
        } else {
            $rules['document'] = 'required|min:11|max:14';
        }

        $this->validate($rules);

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role'     => $this->role, 
            // Limpa caracteres não numéricos do documento
            'document' => preg_replace('/[^0-9]/', '', $this->document),
        ]);

        // Logar o usuário imediatamente após o cadastro
        Auth::login($user);

        // AJUSTE: Redireciona para a Home (Loja)
        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login-register');
    }
}