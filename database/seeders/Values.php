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
        $user1 = User::create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'phone' => '123456789',
            'email_verified_at' => now(),
            'last_name' => 'Last Name 1',
            'birthdate' => '1990-01-01',
            'profile_photo_path' => 'path/to/photo1.jpg',
        ]);

        $user2 = User::create([
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'phone' => '987654321',
            'email_verified_at' => now(),
            'last_name' => 'Last Name 2',
            'birthdate' => '1995-01-01',
            'profile_photo_path' => 'path/to/photo2.jpg',
        ]);

        // Seed Airlines and Airplanes
        $airline1 = Airline::create([
            'name' => 'Airline 1',
            'ubication' => 'Location 1',
        ]);

        $airline2 = Airline::create([
            'name' => 'Airline 2',
            'ubication' => 'Location 2',
        ]);

        $airplane1 = Airplane::create([
            'name' => 'Airplane 1',
            'id_airline' => $airline1->id,
        ]);

        $airplane2 = Airplane::create([
            'name' => 'Airplane 2',
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
            'name' => 'Destiny 1',
            'longitude' => '10.0000',
            'latitude' => '20.0000',
        ]);

        $destiny2 = Destiny::create([
            'name' => 'Destiny 2',
            'longitude' => '30.0000',
            'latitude' => '40.0000',
        ]);

        // Seed Flies and FlyCosts
        $fly1 = Fly::create([
            'depature_date' => '2024-01-01',
            'arrival_date' => '2024-01-02',
            'fly_number' => '123',
            'fly_duration' => '2',
            'id_airplane' => $airplane1->id,
            'id_destinies' => $destiny1->id,
        ]);

        $fly2 = Fly::create([
            'depature_date' => '2024-02-01',
            'arrival_date' => '2024-02-02',
            'fly_number' => '456',
            'fly_duration' => '3',
            'id_airplane' => $airplane2->id,
            'id_destinies' => $destiny2->id,
        ]);

        //seed scales
        Scale::create([
            'id_fly' => $fly1->id,
            'id_destiny' => $destiny2->id,
        ]);

        Scale::create([
            'id_fly' => $fly2->id,
            'id_destiny' => $destiny1->id,
        ]);

        // Seed Passengers
        $seat1 = Seat::where('id_airplane', $airplane1->id)->first();
        $seat2 = Seat::where('id_airplane', $airplane2->id)->first();

        $passenger1 = Passenger::create([
            'name' => 'Passenger 1',
            'last_names' => 'Last Name 1',
            'phone' => '123456789',
            'id_seat' => $seat1->id,
            'id_gender' => 1,
            'id_age' => 2,
            'id_class' => 1,
        ]);

        $passenger2 = Passenger::create([
            'name' => 'Passenger 2',
            'last_names' => 'Last Name 2',
            'phone' => '987654321',
            'id_seat' => $seat2->id,
            'id_gender' => 2,
            'id_age' => 1,
            'id_class' => 2,
        ]);

        $passengerFly1 = PassengerFly::create([
            'id_passenger' => $passenger1->id,
            'if_fly' => $fly1->id,
        ]);

        $passengerFly2 = PassengerFly::create([
            'id_passenger' => $passenger2->id,
            'if_fly' => $fly2->id,
        ]);

        FlyCost::create([
            'cost' => 100,
            'id_fly' => $fly1->id,
            'id_class' => 1,
        ]);

        FlyCost::create([
            'cost' => 200,
            'id_fly' => $fly2->id,
            'id_class' => 2,
        ]);

        // Seed User_Reservation
        $userReservation1 = User_Reservation::create([
            'name' => 'User 1',
            'last_names' => 'Last Name 1',
            'birthdate' => '1990-01-01',
            'email' => 'user1@example.com',
            'phone' => '123456789',
            'id_gender' => 1,
        ]);

        $userReservation2 = User_Reservation::create([
            'name' => 'User 2',
            'last_names' => 'Last Name 2',
            'birthdate' => '1995-01-01',
            'email' => 'user2@example.com',
            'phone' => '987654321',
            'id_gender' => 2,
        ]);

        Service::create([
            'name' => 'Service 1',
            'description' => 'Description 1',
        ]);

        Service::create([
            'name' => 'Service 2',
            'description' => 'Description 2',
        ]);

        // Seed Hotels, Rooms, and Services
        $hotel1 = Hotel::create([
            'name' => 'Hotel 1',
            'description' => 'Description 1',
            'phone' => '123456789',
            'stars' => 5,
            'town_center_distance' => 10,
            'politics' => 'Politics 1',
            'conditions' => 'Conditions 1',
            'id_destiny' => $destiny1->id,
        ]);

        $hotel2 = Hotel::create([
            'name' => 'Hotel 2',
            'description' => 'Description 2',
            'phone' => '987654321',
            'stars' => 4,
            'town_center_distance' => 20,
            'politics' => 'Politics 2',
            'conditions' => 'Conditions 2',
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
            'id_hotels' => $hotel2->id,
            'id_services' => 1,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel2->id,
            'id_services' => 2,
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
            'name' => 'Type 1',
            'description' => 'Description 1',
            'price' => 100,
            'max_people' => 2,
        ]);

        Type_room::create([
            'name' => 'Type 2',
            'description' => 'Description 2',
            'price' => 200,
            'max_people' => 4,
        ]);

        Room::create([
            'name' => 'Room 1',
            'description' => 'Description 1',
            'status' => 0,
            'id_type_rooms' => 1,
            'id_hotel' => $hotel1->id,
        ]);

        Room::create([
            'name' => 'Room 2',
            'description' => 'Description 2',
            'status' => 1,
            'id_type_rooms' => 2,
            'id_hotel' => $hotel2->id,
        ]);

        // Seed Reservations
        $reservation1 = Reservation::create([
            'check_in' => '2024-01-01',
            'check_out' => '2024-01-02',
            'cant_adults' => 2,
            'cant_infants' => 1,
            'status_payment' => 0,
            'id_user_reservation' => $userReservation1->id,
            'id_room' => 1,
        ]);

        $reservation2 = Reservation::create([
            'check_in' => '2024-02-01',
            'check_out' => '2024-02-02',
            'cant_adults' => 2,
            'cant_infants' => 0,
            'status_payment' => 1,
            'id_user_reservation' => $userReservation2->id,
            'id_room' => 2,
        ]);

        // Seed Buy
        $buy1 = Buy::create([
            'id_passenger_fly' => $passengerFly1->id,
            'id_reservation' => 1,
            'id_user' => $user1->id,
        ]);

        $buy2 = Buy::create([
            'id_passenger_fly' => $passengerFly2->id,
            'id_reservation' => 2,
            'id_user' => $user2->id,
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
            'id_user' => $user1->id,
            'created_at' => now(),
        ]);

        Opinion::create([
            'name' => 'Opinion 2',
            'id_hotel' => $hotel2->id,
            'stars' => 4,
            'description' => 'Good hotel!',
            'id_user' => $user2->id,
            'created_at' => now(),
        ]);
    }
}
