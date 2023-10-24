<?php

namespace App\Livewire;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $response = [];
    public $users;

    public function render(): View {
        return view('livewire.search');
    }

    public function updatedSearch(): void {
        $this->response = $this->searchWithTerm()->json();
    }

    private function searchWithTerm(): Response {
        return Http::withHeaders([
            'X-RapidAPI-Host' => env('RAPID_API_HOST'),
            'X-RapidAPI-Key' => env('RAPID_API_KEY'),
        ],)->get('https://movie-database-alternative.p.rapidapi.com/?s='. $this->search. "&r=json");
    }
}
