<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Acesso ao Sistema')]
class LoginRegister extends Component
{
    public $isRegisterMode = false;

    // Propriedades do Formulário
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = ''; // Necessário para a validação
    public $cpf = '';

    public function toggleMode()
    {
        $this->isRegisterMode = !$this->isRegisterMode;
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'cpf']);
        $this->resetValidation();
    }

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return $this->redirect('/dashboard', navigate: true);
        }

        $this->addError('email', 'E-mail ou senha inválidos.');
    }

    public function register()
    {
        //Limpeza do CPF (Remove pontos e traços antes de validar)
        $this->cpf = preg_replace('/[^0-9]/', '', $this->cpf);

        //Validação dos Dados
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|digits:11|unique:users,cpf',
            'password' => 'required|min:8|confirmed',
        ]);

        //Criação no Banco de Dados
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'password' => Hash::make($this->password), // Criptografia da senha
        ]);

        //Logar o usuário imediatamente após o cadastro
        Auth::login($user);

        //Redirecionar para o Dashboard
        return $this->redirect('/dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login-register');
    }
}
