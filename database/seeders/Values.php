<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;
use App\Models\Airplane;
use App\Models\Age;
use App\Models\Buy;
use App\Models\Classe;
use App\Models\Destiny;
use App\Models\Fly;
use App\Models\FlyCost;
use App\Models\Hotel;
use App\Models\Opinion;
use App\Models\Paid;
use App\Models\Passenger;
use App\Models\PassengerFly;
use App\Models\Picture;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Scale;
use App\Models\Seat;
use App\Models\Service;
use App\Models\ServiceHotel;
use App\Models\Type_room;
use App\Models\User;
use App\Models\User_Reservation;

class Values extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Users
        $users = [];
        for ($i = 1; $i <= 10; $i++) {
            $users[] = User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => bcrypt('password'),
                'phone' => '123456789',
                'email_verified_at' => now(),
                'last_name' => "Last Name $i",
                'birthdate' => '1990-01-01',
                'profile_photo_path' => "path/to/photo$i.jpg",
            ]);
        }

        // Seed Airlines and Airplanes
        $airline1 = Airline::create([
            'name' => 'Aeromexico',
            'ubication' => 'CDMX',
        ]);

        $airline2 = Airline::create([
            'name' => 'Volaris',
            'ubication' => 'CDMX',
        ]);

        $airplane1 = Airplane::create([
            'name' => 'F-22',
            'id_airline' => $airline1->id,
        ]);

        $airplane2 = Airplane::create([
            'name' => 'F-69',
            'id_airline' => $airline2->id,
        ]);

        // Seed Ages and Classes
        Age::create([
            'name' => 'Child',
            'max_number' => 12,
            'min_number' => 0,
        ]);

        Age::create([
            'name' => 'Adult',
            'max_number' => 100,
            'min_number' => 13,
        ]);

        Classe::create([
            'type' => 'Economy',
        ]);

        Classe::create([
            'type' => 'Business',
        ]);

        // Seed Seats
        for ($i = 1; $i <= 20; $i++) {
            Seat::create([
                'name' => "Seat $i",
                'id_airplane' => $airplane1->id,
            ]);
        }

        for ($i = 1; $i <= 20; $i++) {
            Seat::create([
                'name' => "Seat $i",
                'id_airplane' => $airplane2->id,
            ]);
        }

        // Seed Destinies
        $destiny1 = Destiny::create([
            'name' => 'Italia',
            'longitude' => '10.0000',
            'latitude' => '20.0000',
        ]);

        $destiny2 = Destiny::create([
            'name' => 'Bogota',
            'longitude' => '30.0000',
            'latitude' => '40.0000',
        ]);

        // Seed Flies and FlyCosts
        $fly1 = Fly::create([
            'depature_date' => '2024-01-01',
            'arrival_date' => '2024-01-02',
            'fly_number' => '486',
            'fly_duration' => '8',
            'id_airplane' => $airplane1->id,
            'id_destinies' => $destiny1->id,
        ]);

        $fly2 = Fly::create([
            'depature_date' => '2024-02-01',
            'arrival_date' => '2024-02-02',
            'fly_number' => '555',
            'fly_duration' => '8',
            'id_airplane' => $airplane2->id,
            'id_destinies' => $destiny2->id,
        ]);

        // Seed Scales
        Scale::create([
            'id_fly' => $fly1->id,
            'id_destiny' => $destiny2->id,
        ]);

        Scale::create([
            'id_fly' => $fly1->id,
            'id_destiny' => $destiny1->id,
        ]);

        Scale::create([
            'id_fly' => $fly2->id,
            'id_destiny' => $destiny1->id,
        ]);

        // Seed Passengers
        $seats1 = Seat::where('id_airplane', $airplane1->id)->get();
        $seats2 = Seat::where('id_airplane', $airplane2->id)->get();

        foreach ($seats1 as $seat) {
            $passenger = Passenger::create([
                'name' => 'Passenger ' . $seat->name,
                'last_names' => 'Last Name ' . $seat->name,
                'phone' => '123456789',
                'id_seat' => $seat->id,
                'id_gender' => 1,
                'id_age' => 2,
                'id_class' => 1,
            ]);

            PassengerFly::create([
                'id_passenger' => $passenger->id,
                'if_fly' => $fly1->id,
            ]);
        }

        foreach ($seats2 as $seat) {
            $passenger = Passenger::create([
                'name' => 'Passenger ' . $seat->name,
                'last_names' => 'Last Name ' . $seat->name,
                'phone' => '987654321',
                'id_seat' => $seat->id,
                'id_gender' => 2,
                'id_age' => 1,
                'id_class' => 2,
            ]);

            PassengerFly::create([
                'id_passenger' => $passenger->id,
                'if_fly' => $fly2->id,
            ]);
        }

        FlyCost::create([
            'cost' => 100,
            'id_fly' => $fly1->id,
            'id_class' => 1,
        ]);

        FlyCost::create([
            'cost' => 100,
            'id_fly' => $fly1->id,
            'id_class' => 2,
        ]);

        FlyCost::create([
            'cost' => 200,
            'id_fly' => $fly2->id,
            'id_class' => 1,
        ]);

        FlyCost::create([
            'cost' => 200,
            'id_fly' => $fly2->id,
            'id_class' => 2,
        ]);

        // Seed User_Reservation
        $userReservations = [];
        for ($i = 1; $i <= 10; $i++) {
            $userReservations[] = User_Reservation::create([
                'name' => "User $i",
                'last_names' => "Last Name $i",
                'birthdate' => '1990-01-01',
                'email' => "user$i@example.com",
                'phone' => '123456789',
                'id_gender' => $i % 2 == 0 ? 1 : 2,
            ]);
        }

        Service::create([
            'name' => 'Piscina',
            'description' => 'Piscina interior y exterior',
        ]);

        Service::create([
            'name' => 'Servicio al cuarto',
            'description' => 'Servicio de habitaciones 24/7',
        ]);

        Service::create([
            'name' => 'WiFi gratis',
            'description' => 'Acceso a internet de alta velocidad',
        ]);

        Service::create([
            'name' => 'Spa',
            'description' => 'Spa de servicio completo',
        ]);

        Service::create([
            'name' => 'Gimnasio',
            'description' => 'Centro de fitness completamente equipado',
        ]);

        // Seed Hotels, Rooms, and Services
        $hotel1 = Hotel::create([
            'name' => 'Miravel',
            'description' => 'Hotel en el centro de la cuidad con vista a la ciudad',
            'phone' => '442514789',
            'stars' => 5,
            'town_center_distance' => 100,
            'politics' => 'Los termnos y condiciones de cancelación y pago varían según el tipo de habitación',
            'conditions' => 'Condiciones de cancelación y pago',
            'id_destiny' => $destiny1->id,
        ]);

        $hotel2 = Hotel::create([
            'name' => 'Luxemburgo',
            'description' => 'Hotel a mitad de la montaña',
            'phone' => '4897586632',
            'stars' => 4,
            'town_center_distance' => 20000,
            'politics' => 'Los términos y condiciones de cancelación y pago varían según el tipo de habitación',
            'conditions' => 'Condiciones de cancelación y pago',
            'id_destiny' => $destiny2->id,
        ]);

        // Seed ServiceHotel
        ServiceHotel::create([
            'id_hotels' => $hotel1->id,
            'id_services' => 1,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel1->id,
            'id_services' => 2,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel1->id,
            'id_services' => 3,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel2->id,
            'id_services' => 2,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel2->id,
            'id_services' => 3,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel2->id,
            'id_services' => 4,
        ]);

        Picture::create([
            'name' => 'picture1.jpg',
            'description' => 'Description 1',
            'id_hotel' => $hotel1->id,
        ]);

        Picture::create([
            'name' => 'picture2.jpg',
            'description' => 'Description 2',
            'id_hotel' => $hotel2->id,
        ]);

        // Seeder type_room
        Type_room::create([
            'name' => 'Sencilla',
            'description' => 'Habitación sencilla con cama matrimonial',
            'price' => 200,
            'max_people' => 2,
        ]);

        Type_room::create([
            'name' => 'Doble',
            'description' => 'Habitación doble con dos camas individuales',
            'price' => 150,
            'max_people' => 2,
        ]);

        Type_room::create([
            'name' => 'Triple',
            'description' => 'Habitación triple con tres camas individuales',
            'price' => 250,
            'max_people' => 3,
        ]);

        Type_room::create([
            'name' => 'Familiar',
            'description' => 'Habitación familiar con dos camas matrimoniales',
            'price' => 300,
            'max_people' => 4,
        ]);

        Type_room::create([
            'name' => 'Presidencial',
            'description' => 'Suite presidencial con sala de estar, comedor y jacuzzi',
            'price' => 500,
            'max_people' => 8,
        ]);

        for ($i = 1; $i <= 40; $i++) {
            Room::create([
                'name' => "Room $i",
                'description' => "Description $i",
                'status' => $i % 2,
                'id_type_rooms' => ($i % 2) + 1,
                'id_hotel' => $i <= 20 ? $hotel1->id : $hotel2->id,
            ]);
        }

        // Seed Reservations
        $reservation1 = Reservation::create([
            'check_in' => '2024-01-01',
            'check_out' => '2024-01-02',
            'cant_adults' => 2,
            'cant_infants' => 1,
            'status_payment' => 0,
            'id_user_reservation' => $userReservations[0]->id,
            'id_room' => 1,
        ]);

        $reservation2 = Reservation::create([
            'check_in' => '2024-02-01',
            'check_out' => '2024-02-02',
            'cant_adults' => 2,
            'cant_infants' => 0,
            'status_payment' => 1,
            'id_user_reservation' => $userReservations[1]->id,
            'id_room' => 2,
        ]);

        // Seed Buy
        $buy1 = Buy::create([
            'id_passenger_fly' => PassengerFly::first()->id,
            'id_reservation' => $reservation1->id,
            'id_user' => $users[0]->id,
        ]);

        $buy2 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(1)->first()->id,
            'id_reservation' => $reservation2->id,
            'id_user' => $users[1]->id,
        ]);

        Paid::create([
            'id_buy' => $buy1->id,
            'cantidad' => 100,
            'buyer' => 'Buyer 1',
        ]);

        Paid::create([
            'id_buy' => $buy2->id,
            'cantidad' => 200,
            'buyer' => 'Buyer 2',
        ]);

        // Seed Opinions and Pictures
        Opinion::create([
            'name' => 'Opinion 1',
            'id_hotel' => $hotel1->id,
            'stars' => 5,
            'description' => 'Great hotel!',
            'id_user' => $users[0]->id,
            'created_at' => now(),
        ]);

        Opinion::create([
            'name' => 'Opinion 2',
            'id_hotel' => $hotel2->id,
            'stars' => 4,
            'description' => 'Good hotel!',
            'id_user' => $users[1]->id,
            'created_at' => now(),
        ]);
    }
}
