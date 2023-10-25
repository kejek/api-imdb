<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public string $search;
    public array $response;
    public string $apiHost = '';
    public array $headers = [];
    public bool $hasSearched = false;

    protected $rules = [
        'search' => 'required',
    ];

    public function mount($host = null, $headers = null): void {
        $this->apiHost = 'https://'.env('RAPID_API_HOST');
        $this->headers = [
            'X-RapidAPI-Host' => env('RAPID_API_HOST'),
            'X-RapidAPI-Key' => env('RAPID_API_KEY'),
        ];
    }

    public function render(): View {
        return view('livewire.search');
    }

    public function updatedSearch(): void {
        if(!empty($this->search)) {
            $searchResults = $this->searchWithTerm();
            $results = [];
            $this->hasSearched = true;

            if(array_key_exists('Search', $searchResults)) {
                foreach($searchResults['Search'] as $item) {
                    $details = $this->getMoreDetails($item['imdbID']);
                    $item['Plot'] = $details['Plot'];
                    $item['Released'] = $details['Released'];
                    $item['Director'] = $details['Director'];
                    $results[] = $item;
                }

                $this->response = $results;
            }
        }
    }

    private function searchWithTerm(): array {
        return Http::withHeaders($this->headers)
            ->get($this->apiHost .'/?s='. $this->search. '&r=json')->json();
    }

    private function getMoreDetails(string $id): array {
        return Http::withHeaders($this->headers)
            ->get($this->apiHost .'/?i='. $id .'&r=json')->json();
    }
}
