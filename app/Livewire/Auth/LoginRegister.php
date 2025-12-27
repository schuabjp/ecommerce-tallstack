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

    public $role = 'customer';
    public $document = '';

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
        // Validação condicional
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:customer,seller', // Garante que ninguém force 'admin' via Inspecionar Elemento
        ];

        // Se for vendedor, documento é obrigatório. Se cliente, CPF obrigatório.
        if ($this->role === 'seller') {
            $rules['document'] = 'required|min:11|max:18';
        } else {
            $rules['document'] = 'required|digits:11';
        }

        $this->validate($rules);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role, // O cast do Model converte string para Enum
            'document' => preg_replace('/[^0-9]/', '', $this->document),
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
