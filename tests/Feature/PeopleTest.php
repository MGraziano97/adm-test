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

        $response->assertStatus(200);
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
        $sort_by = 'gender';
    
        $response = $this->json('GET', "/api/people?sort={$sort_by}");

        $response->assertStatus(200);
    }

    /** @test */
    public function sort_list_of_people_with_unavailable_field()
    {
        $sort_by = 'height';
    
        $response = $this->json('GET', "/api/people?sort={$sort_by}");

        $response->assertStatus(400);
    }

    /** @test */
    public function a_list_of_people_with_filters()
    {
        $name = 'Luke';
    
        $response = $this->json('GET', "/api/people?filter[name]={$name}");

        $response->assertStatus(200);
    }

    /** @test */
    public function filter_people_with_unavavailable_filter()
    {
        $field = 'height';
    
        $response = $this->json('GET', "/api/people?filter[{$field}]=test");

        $response->assertStatus(400);
    }

    /** @test */
    public function find_person() {
        $response = $this->json('GET', '/api/people/1');

        $response->assertStatus(200);
    }

    /** @test */
    public function cannot_find_person() {
        $response = $this->json('GET', '/api/people/0');

        $response->assertStatus(404);
    }
}
