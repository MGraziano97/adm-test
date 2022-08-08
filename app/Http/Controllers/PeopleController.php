<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Resources\Person as PersonResource;

class PeopleController extends Controller
{
    public function index(Request $request) {
        $query = Person::query();

        if ($q = trim($request->input('name', ''))) {
            $query->where('name', 'like', "%{$q}%");
        }

        if ($q = trim($request->input('sort_by', ''))) {
            $query->orderBy($q);
        } else {
            $query->orderBy('name');
        }

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
