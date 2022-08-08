<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    /** @test */
    public function a_full_list_of_people()
    {
        $response = $this->json('GET', '/api/people');

        $response
            ->assertStatus(200);
    }

    /** @test */
    public function a_paginated_list_of_people()
    {
        $itemsPerPage = 5;

        $response = $this->json('GET', "/api/people?page_size={$itemsPerPage}");

        $response
            ->assertStatus(200)
            ->assertJsonCount($itemsPerPage, 'data');
    }

    /** @test */
    public function a_sorted_list_of_people()
    {
        $sort_by = 'height';
    
        $response = $this->json('GET', "/api/people?sort_by={$sort_by}");

        $response->assertStatus(200);
    }

    /** @test */
    public function a_list_of_people_with_filters()
    {
        $name = 'Luke';
    
        $response = $this->json('GET', "/api/people?name={$name}");

        $response->assertStatus(200);
    }
}
