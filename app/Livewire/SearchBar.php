<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchBar extends Component
{
    public $search = '';

    public function render()
    {
        $movieResults = [];
        $actorResults = [];

        if (strlen($this->search) >= 2) {
            $movieResults = Http::get('https://api.themoviedb.org/3/search/movie?query=' . $this->search . '&api_key=' . config('services.tmdb.token'))
                ->json()['results'];

            $actorResults = Http::get('https://api.themoviedb.org/3/search/person?query=' . $this->search . '&api_key=' . config('services.tmdb.token'))
                ->json()['results'];
        }

        return view('livewire.search-bar', [
            'movieResults' => collect($movieResults)->take(7),
            'actorResults' => collect($actorResults)->take(7),
        ]);
    }
}

