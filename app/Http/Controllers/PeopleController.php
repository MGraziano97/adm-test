<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Resources\Person as PersonResource;
use Spatie\QueryBuilder\QueryBuilder;

class PeopleController extends Controller
{
    public function index(Request $request) {
        $query = QueryBuilder::for(Person::class)
            ->allowedFilters('name', 'gender')
            ->allowedSorts('name', 'gender'); 

        if ($request->has('page_size')) {
            $people = $query->paginate($request->page_size);
        } else {
            $people = $query->paginate(14);
        }
        return PersonResource::collection($people);
    } 

    public function find(Person $person) {
        return new PersonResource($person);
    }
}
