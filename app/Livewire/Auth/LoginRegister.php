<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Acesso ao E-commerce')]
class LoginRegister extends Component
{
    // Lógica do componente
    public $isRegisterMode = false;
    public $isLoggedIn = false; // Este é controlado pelo middleware de rota, mas mantido para a UI inicial

    // Propriedades do formulário (wire:model)
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $cpf = '';

    // Metodo que alterna entre as telas de Login e Registro
    public function toggleMode()
    {
        $this->isRegisterMode = !$this->isRegisterMode;
        $this->reset(['email', 'password', 'password_confirmation', 'name', 'cpf']);
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
            // Redirecionamento usando Livewire Navigation (navigate: true)
            return $this->redirect('/dashboard', navigate: true);
        }

        $this->addError('email', 'As credenciais fornecidas não coincidem com nossos registros.');
    }

    public function register()
    {
        // Validação estrita
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|digits:11|unique:users,cpf',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        return $this->redirect('/dashboard', navigate: true);
    }

    // Metodo para aplicar máscara no CPF em tempo real (opcional, mas melhora UX)
    public function updatedCpf($value)
    {
        // Remove tudo que não for dígito
        $cleanCpf = preg_replace('/[^0-9]/', '', $value);

        // Aplica a máscara se tiver 11 dígitos
        if (strlen($cleanCpf) === 11) {
            $this->cpf = preg_replace('/[^0-9]/', '', $this->cpf);
        } else {
            $this->cpf = $cleanCpf;
        }
    }

    public function render()
    {
        return view('livewire.auth.login-register');
    }
}
