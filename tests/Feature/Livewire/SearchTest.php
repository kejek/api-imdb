<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Search;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Search::class)
            ->assertStatus(200);
    }

    /** @test */
    public function has_data_passed_correctly()
    {
        Http::preventStrayRequests();

        Http::fake([
            'https://testurl.com/?s=*' => Http::response([
                'Search' => [
                    [
                        'Title' => 'Test Movie',
                        'Year' => '2019',
                        'imdbID' => 'tt4154796',
                        'Type' => 'movie',
                        'Poster' => 'https://www.fake.com/fake.jpg',
                    ],
                ],
                'totalResults' => '1',
                'Response' => 'True',
            ]),
            'https://testurl.com/?i=*' => Http::response([
                'Plot' => 'This is a test',
                'Director' => 'Cool Dude',
                'Released' => 'May 1st 2019',
                'totalResults' => '1',
                'Response' => 'True',
            ]),
        ]);

        Livewire::test(Search::class)
            ->set('search', 'bar')
            ->assertSet('search', 'bar');
    }

    /** @test */
    public function has_search_results()
    {
        Http::preventStrayRequests();

        Http::fake([
            'https://testurl.com/?s=*' => Http::response([
                'Search' => [
                    [
                        'Title' => 'Test Movie',
                        'Year' => '2019',
                        'imdbID' => 'tt4154796',
                        'Type' => 'movie',
                        'Poster' => 'https://www.fake.com/fake.jpg',
                    ],
                ],
                'totalResults' => '1',
                'Response' => 'True',
            ]),
            'https://testurl.com/?i=*' => Http::response([

                'Plot' => 'This is a test',
                'Director' => 'Cool Dude',
                'Released' => 'May 1st 2019',

                'totalResults' => '1',
                'Response' => 'True',
            ]),
        ]);

        Livewire::test(Search::class)
            ->set('search', 'Test')
            ->assertSee('Test Movie');

    }
}
