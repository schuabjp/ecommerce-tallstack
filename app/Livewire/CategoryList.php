<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryList extends Component
{
    // --- Variáveis do Formulário ---
    #[Validate('required|min:3|max:50')]
    public $name = '';

    #[Validate('required')]
    public $color = '#3b82f6'; // Cor padrão (Azul)

    public $editingCategory = null; // Guarda a categoria se estivermos editando

    // --- Ações ---

    public function save()
    {
        // 1. Validação
        $this->validate();

        // 2. Verifica se é Criação ou Edição
        if ($this->editingCategory) {
            // Atualizar existente
            $this->editingCategory->update([
                'name'  => $this->name,
                'color' => $this->color,
            ]);
            session()->flash('message', 'Categoria atualizada com sucesso!');
        } else {
            // Criar nova
            Category::create([
                'name'    => $this->name,
                'color'   => $this->color,
                'user_id' => Auth::id(),
            ]);
            session()->flash('message', 'Categoria criada com sucesso!');
        }

        // 3. Limpeza
        $this->cancel(); // Reseta o formulário
    }

    public function edit($id)
    {
        // Busca a categoria e preenche o formulário
        $this->editingCategory = Category::find($id);
        $this->name = $this->editingCategory->name;
        $this->color = $this->editingCategory->color;
    }

    public function delete($id)
    {
        // Verifica se existe e apaga (Soft Delete)
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            session()->flash('message', 'Categoria removida.');
        }
    }

    public function cancel()
    {
        // Limpa tudo para voltar ao modo "Criar Novo"
        $this->reset(['name', 'color', 'editingCategory']);
    }

    public function render()
    {
        // Retorna a lista ordenada pelas mais recentes
        return view('livewire.category-list', [
            'categories' => Category::latest()->get(),
        ]);
    }
}
