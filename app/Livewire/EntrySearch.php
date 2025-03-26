<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry;
use Illuminate\Support\Facades\Auth;

class EntrySearch extends Component
{
    public $search = '';

    public function render()
    {
        $entries = Entry::where('description', 'LIKE', "%{$this->search}%")
                        ->orWhere('branch', 'LIKE', "%{$this->search}%")
                        ->orWhere('received_by', 'LIKE', "%{$this->search}%")
                        ->get();

        return view('livewire.entry-search', compact('entries'));
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }
}
