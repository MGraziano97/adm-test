<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Person;
use App\Models\Planet;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Http;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from APIs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $page = 1;
        
        $client = new \GuzzleHttp\Client();
        // Get all people
        do {
            $res = $client->request('GET', 'https://swapi.dev/api/people/?page=' . $page);
            $json = json_decode($res->getBody());
            foreach($json->results as $person) {
                Person::updateOrCreate([
                    'url' => $person->url
                ], [
                    'name' => $person->name,
                    'height' => $person->height,
                    'mass' => $person->mass,
                    'hair_color' => $person->hair_color,
                    'skin_color' => $person->skin_color,
                    'eye_color' => $person->eye_color,
                    'birth_year' => $person->birth_year,
                    'gender' => $person->gender,
                    'homeworld' => $person->homeworld,
                    'films' => $person->films,
                    'species' => $person->species,
                    'vehicles' => $person->vehicles,
                    'starships' => $person->starships,
                    'created' => Carbon::parse($person->created)->format('Y-m-d H:i:s'),
                    'edited' => Carbon::parse($person->edited)->format('Y-m-d H:i:s'),
                ]);
            }
            $page ++;
        } while ($json->next != null);

        // Get all planets
        $page = 1;
        do {
            $res = $client->request('GET', 'https://swapi.dev/api/planets/?page=' . $page);
            $json = json_decode($res->getBody());
            foreach($json->results as $planet) {
                Planet::updateOrCreate([
                    'url' => $planet->url
                ], [
                    'name' => $planet->name,
                    'diameter' => $planet->diameter,
                    'rotation_period' => $planet->rotation_period,
                    'orbital_period' => $planet->orbital_period,
                    'gravity' => $planet->gravity,
                    'population' => $planet->population,
                    'climate' => $planet->climate,
                    'terrain' => $planet->terrain,
                    'surface_water' => $planet->surface_water,
                    'residents' => $planet->residents,
                    'films' => $planet->films,
                    'created' => Carbon::parse($person->created)->format('Y-m-d H:i:s'),
                    'edited' => Carbon::parse($person->edited)->format('Y-m-d H:i:s'),
                ]);
            }
            $page ++;
        } while ($json->next != null);


    }
}
