<?php

namespace Database\Seeders;

use App\Models\Train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TrainsSeeder extends Seeder
{
    /**
     * return a string with the number with eventually a/some 0s ahead
     *
     * @param int $n
     * @return string
     */
    public function getTrainCode(int $n){

        if($n < 10){
            return '0000'.$n;
        }
        else if($n < 100){
            return '000'.$n;
        }
        else if($n < 1000){
            return '00'.$n;
        }
        else if($n < 10000){
            return '0'.$n;
        }
        else{
            return  (string)$n;
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
            $train = new Train();
            $train->company = $faker->company();
            $departure = $faker->randomElement(['Sassari', 'Mandas', 'Nuoro', 'Prato Sardo', 'Gesico', 'Suelli', 'Oniferi', 'Senorbì', 'Orotelli', 'Barrali', 'Iscra', 'Cagliari']);
            $train->departure_station = $departure;
            $arrival = '';
            do{
                //per assegnare un arrivo diverso dalla partenza
                $arrival = $faker->randomElement(['Sassari', 'Mandas', 'Nuoro', 'Prato Sardo', 'Gesico', 'Suelli', 'Oniferi', 'Senorbì', 'Orotelli', 'Barrali', 'Iscra', 'Cagliari']);
            }while($departure === $arrival);
            $train->arrival_station = $arrival;
            $train->departure_date_time = $train->arrival_date_time = $faker->date('Y/m/d') .'-'. $faker->date('H:i:s'); //in sardegna i treni ci mettono massimo 4 ore e non partono la notte
            //var_dump( $faker->date('Y/m/d') .'-'. $faker->date('H:i:s'));
            $train->train_code = $this->getTrainCode($faker->randomNumber(5, false));
            $train->n_compartment = $faker->numberBetween(5,10);
            $train->is_cancelled = $cancelled = $faker->randomElement([true, false]);
            $train->on_schedule = ($cancelled) ? false : $faker->randomElement([true, false]);
            $train->save();
        }
    }
}
