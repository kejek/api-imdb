<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Search;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
