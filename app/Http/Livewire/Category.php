<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class Messages extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // $categoriess = Category::where('nameVi', 'like', '%'.$this->search.'%')->paginate(10);
        // dd($categoriess);
        // return view('Backend.categories.index', [
        //     'categoriess' => $categoriess,
        // ]);
    }
}
