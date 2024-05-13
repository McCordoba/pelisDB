<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchBar extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = Http::get('https://api.themoviedb.org/3/search/movie?query='.$this->search.'&api_key='.config('services.tmdb.token'))
                ->json()['results'];
        }

       //dump($searchResults);

        return view('livewire.search-bar', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
