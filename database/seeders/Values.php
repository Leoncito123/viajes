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
        // Adding more airlines...
        $airline3 = Airline::create([
            'name' => 'Interjet',
            'ubication' => 'Guadalajara',
        ]);
        $airline4 = Airline::create([
            'name' => 'Delta Airlines',
            'ubication' => 'Atlanta',
        ]);

        // Creating airplanes for airlines
        $airplane1 = Airplane::create(['name' => 'F-22', 'id_airline' => $airline1->id]);
        $airplane2 = Airplane::create(['name' => 'F-69', 'id_airline' => $airline2->id]);
        $airplane3 = Airplane::create(['name' => 'Boeing 737', 'id_airline' => $airline3->id]);
        $airplane4 = Airplane::create(['name' => 'Airbus A320', 'id_airline' => $airline4->id]);

        // Seed Age and Classes
        Age::create(['name' => 'Child', 'max_number' => 12, 'min_number' => 0]);
        Age::create(['name' => 'Adult', 'max_number' => 100, 'min_number' => 13]);
        Classe::create(['type' => 'Economy']);
        Classe::create(['type' => 'Business']);

        // Seed Seats
        for ($i = 1; $i <= 20; $i++) {
            Seat::create(['name' => "Seat $i", 'id_airplane' => $airplane1->id]);
        }

        for ($i = 1; $i <= 20; $i++) {
            Seat::create(['name' => "Seat $i", 'id_airplane' => $airplane2->id]);
        }

        for ($i = 1; $i <= 20; $i++) {
            Seat::create(['name' => "Seat $i", 'id_airplane' => $airplane3->id]);
        }

        for ($i = 1; $i <= 20; $i++) {
            Seat::create(['name' => "Seat $i", 'id_airplane' => $airplane4->id]);
        }

        // Seed Destinies
        $destiny1 = Destiny::create(['name' => 'Italia', 'longitude' => '10.0000', 'latitude' => '20.0000']);
        $destiny2 = Destiny::create(['name' => 'Bogota', 'longitude' => '30.0000', 'latitude' => '40.0000']);

        // Seed Flights and FlyCosts
        $fly1 = Fly::create([
            'depature_date' => '2024-01-01',
            'arrival_date' => '2024-01-02',
            'fly_number' => '486',
            'fly_duration' => '8',
            'id_airplane' => $airplane1->id,
            'id_destinies' => $destiny1->id,
        ]);

        // Add more flights
        $fly2 = Fly::create([
            'depature_date' => '2024-02-01',
            'arrival_date' => '2024-02-02',
            'fly_number' => '555',
            'fly_duration' => '8',
            'id_airplane' => $airplane2->id,
            'id_destinies' => $destiny2->id,
        ]);

        $fly3 = Fly::create([
            'depature_date' => '2024-03-01',
            'arrival_date' => '2024-03-02',
            'fly_number' => '777',
            'fly_duration' => '10',
            'id_airplane' => $airplane3->id,
            'id_destinies' => $destiny1->id,
        ]);

        $fly4 = Fly::create([
            'depature_date' => '2024-04-01',
            'arrival_date' => '2024-04-02',
            'fly_number' => '888',
            'fly_duration' => '12',
            'id_airplane' => $airplane4->id,
            'id_destinies' => $destiny2->id,
        ]);

        // Seed Scales
        Scale::create(['id_fly' => $fly1->id, 'id_destiny' => $destiny2->id]);
        Scale::create(['id_fly' => $fly1->id, 'id_destiny' => $destiny1->id]);
        Scale::create(['id_fly' => $fly2->id, 'id_destiny' => $destiny1->id]);
        Scale::create(['id_fly' => $fly3->id, 'id_destiny' => $destiny2->id]);
        Scale::create(['id_fly' => $fly4->id, 'id_destiny' => $destiny1->id]);

        // Seed Passengers
        $seats1 = Seat::where('id_airplane', $airplane1->id)->get();
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
            PassengerFly::create(['id_passenger' => $passenger->id, 'if_fly' => $fly1->id]);
        }

        $seats2 = Seat::where('id_airplane', $airplane2->id)->get();
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
            PassengerFly::create(['id_passenger' => $passenger->id, 'if_fly' => $fly2->id]);
        }

        $seats3 = Seat::where('id_airplane', $airplane3->id)->get();
        foreach ($seats3 as $seat) {
            $passenger = Passenger::create([
                'name' => 'Passenger ' . $seat->name,
                'last_names' => 'Last Name ' . $seat->name,
                'phone' => '123456789',
                'id_seat' => $seat->id,
                'id_gender' => 1,
                'id_age' => 2,
                'id_class' => 1,
            ]);
            PassengerFly::create(['id_passenger' => $passenger->id, 'if_fly' => $fly3->id]);
        }

        $seats4 = Seat::where('id_airplane', $airplane4->id)->get();
        foreach ($seats4 as $seat) {
            $passenger = Passenger::create([
                'name' => 'Passenger ' . $seat->name,
                'last_names' => 'Last Name ' . $seat->name,
                'phone' => '987654321',
                'id_seat' => $seat->id,
                'id_gender' => 2,
                'id_age' => 1,
                'id_class' => 2,
            ]);
            PassengerFly::create(['id_passenger' => $passenger->id, 'if_fly' => $fly4->id]);
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

        FlyCost::create([
            'cost' => 300,
            'id_fly' => $fly3->id,
            'id_class' => 1,
        ]);

        FlyCost::create([
            'cost' => 300,
            'id_fly' => $fly3->id,
            'id_class' => 2,
        ]);

        FlyCost::create([
            'cost' => 400,
            'id_fly' => $fly4->id,
            'id_class' => 1,
        ]);

        FlyCost::create([
            'cost' => 400,
            'id_fly' => $fly4->id,
            'id_class' => 2,
        ]);

        // Seed User Reservations
        $userReservations = [];
        foreach ($users as $user) {
            $userReservations[] = User_Reservation::create([
                'name' => $user->name,
                'last_names' => $user->last_name,
                'birthdate' => $user->birthdate,
                'email' => $user->email,
                'phone' => $user->phone,
                'id_gender' => $user->id % 2 == 0 ? 1 : 2,
            ]);
        }

        // Seed Services
        $service1 = Service::create([
            'name' => 'Piscina',
            'description' => 'Piscina interior y exterior',
        ]);

        $service2 = Service::create([
            'name' => 'Servicio al cuarto',
            'description' => 'Servicio de habitaciones 24/7',
        ]);

        $service3 = Service::create([
            'name' => 'WiFi gratis',
            'description' => 'Acceso a internet de alta velocidad',
        ]);

        $service4 = Service::create([
            'name' => 'Spa',
            'description' => 'Spa de servicio completo',
        ]);

        $service5 = Service::create([
            'name' => 'Gimnasio',
            'description' => 'Centro de fitness completamente equipado',
        ]);

        $service6 = Service::create([
            'name' => 'Restaurante',
            'description' => 'Restaurante gourmet',
        ]);

        // Seed Hotels, Rooms, and Services
        $hotel1 = Hotel::create([
            'name' => 'Miravel',
            'description' => 'Hotel in the city center with a city view',
            'phone' => '442514789',
            'stars' => 5,
            'town_center_distance' => 100,
            'politics' => 'Terms and conditions for cancellation and payment vary by room type',
            'conditions' => 'Cancellation and payment conditions',
            'id_destiny' => $destiny1->id,
        ]);

        $hotel2 = Hotel::create([
            'name' => 'Luxemburgo',
            'description' => 'Hotel a mitad de la montaña',
            'phone' => '4897586632',
            'stars' => 4,
            'town_center_distance' => 20000,
            'politics' => 'Terms and conditions for cancellation and payment vary by room type',
            'conditions' => 'Cancellation and payment conditions',
            'id_destiny' => $destiny2->id,
        ]);

        // Add more hotels
        $hotel3 = Hotel::create([
            'name' => 'Costa Azul',
            'description' => 'Beachfront hotel with ocean view',
            'phone' => '5532148965',
            'stars' => 4,
            'town_center_distance' => 5000,
            'politics' => 'Terms and conditions for cancellation and payment vary by room type',
            'conditions' => 'Cancellation and payment conditions',
            'id_destiny' => $destiny1->id,
        ]);

        $hotel4 = Hotel::create([
            'name' => 'Montaña Verde',
            'description' => 'Mountain hotel with hiking trails',
            'phone' => '5536541230',
            'stars' => 3,
            'town_center_distance' => 15000,
            'politics' => 'Terms and conditions for cancellation and payment vary by room type',
            'conditions' => 'Cancellation and payment conditions',
            'id_destiny' => $destiny2->id,
        ]);

        $hotel5 = Hotel::create([
            'name' => 'Hotel Bahía',
            'description' => 'Luxury hotel with private beach access',
            'phone' => '5547894560',
            'stars' => 5,
            'town_center_distance' => 200,
            'politics' => 'Terms and conditions for cancellation and payment vary by room type',
            'conditions' => 'Cancellation and payment conditions',
            'id_destiny' => $destiny1->id,
        ]);


        // Seed ServiceHotel for additional hotels
        ServiceHotel::create([
            'id_hotels' => $hotel1->id,
            'id_services' => $service1->id,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel1->id,
            'id_services' => $service2->id,
        ]);


        // Seed ServiceHotel for additional hotels
        ServiceHotel::create([
            'id_hotels' => $hotel2->id,
            'id_services' => $service3->id,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel2->id,
            'id_services' => $service5->id,
        ]);

        // Seed ServiceHotel for additional hotels
        ServiceHotel::create([
            'id_hotels' => $hotel3->id,
            'id_services' => $service1->id,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel3->id,
            'id_services' => $service2->id,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel3->id,
            'id_services' => $service3->id,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel4->id,
            'id_services' => $service4->id,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel4->id,
            'id_services' => $service5->id,
        ]);

        ServiceHotel::create([
            'id_hotels' => $hotel5->id,
            'id_services' => $service6->id,
        ]);

        // Seed Pictures for additional hotels
        Picture::create([
            'name' => 'picture3.jpg',
            'description' => 'Ocean view from the hotel room',
            'id_hotel' => $hotel3->id,
        ]);

        Picture::create([
            'name' => 'picture4.jpg',
            'description' => 'Mountain trails at the hotel',
            'id_hotel' => $hotel4->id,
        ]);

        Picture::create([
            'name' => 'picture5.jpg',
            'description' => 'Private beach at Hotel Bahía',
            'id_hotel' => $hotel5->id,
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

        // Seed Rooms for additional hotels
        for ($i = 1; $i <= 20; $i++) {
            Room::create([
                'name' => "Room $i",
                'description' => "Description $i",
                'status' => $i % 2,
                'id_type_rooms' => ($i % 5) + 1, // Ensure id_type_rooms exists
                'id_hotel' => $hotel1->id,
            ]);
        }

        for ($i = 21; $i <= 40; $i++) {
            Room::create([
                'name' => "Room $i",
                'description' => "Description $i",
                'status' => $i % 2,
                'id_type_rooms' => ($i % 5) + 1, // Ensure id_type_rooms exists
                'id_hotel' => $hotel2->id,
            ]);
        }

        for ($i = 41; $i <= 60; $i++) {
            Room::create([
                'name' => "Room $i",
                'description' => "Description $i",
                'status' => $i % 2,
                'id_type_rooms' => ($i % 5) + 1, // Ensure id_type_rooms exists
                'id_hotel' => $hotel3->id,
            ]);
        }

        for ($i = 61; $i <= 80; $i++) {
            Room::create([
                'name' => "Room $i",
                'description' => "Description $i",
                'status' => $i % 2,
                'id_type_rooms' => ($i % 5) + 1, // Ensure id_type_rooms exists
                'id_hotel' => $hotel4->id,
            ]);
        }

        for ($i = 81; $i <= 100; $i++) {
            Room::create([
                'name' => "Room $i",
                'description' => "Description $i",
                'status' => $i % 2,
                'id_type_rooms' => ($i % 5) + 1, // Ensure id_type_rooms exists
                'id_hotel' => $hotel5->id,
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

        // Add more reservations
        $reservation3 = Reservation::create([
            'check_in' => '2024-03-01',
            'check_out' => '2024-03-05',
            'cant_adults' => 4,
            'cant_infants' => 2,
            'status_payment' => 0,
            'id_user_reservation' => $userReservations[2]->id,
            'id_room' => 3,  // Assuming room 3 exists
        ]);

        $reservation4 = Reservation::create([
            'check_in' => '2024-04-10',
            'check_out' => '2024-04-15',
            'cant_adults' => 3,
            'cant_infants' => 0,
            'status_payment' => 1,
            'id_user_reservation' => $userReservations[3]->id,
            'id_room' => 4,  // Assuming room 4 exists
        ]);

        $reservation5 = Reservation::create([
            'check_in' => '2024-05-01',
            'check_out' => '2024-05-02',
            'cant_adults' => 2,
            'cant_infants' => 1,
            'status_payment' => 0,
            'id_user_reservation' => $userReservations[4]->id,
            'id_room' => 5,  // Assuming room 5 exists
        ]);

        $reservation6 = Reservation::create([
            'check_in' => '2024-06-20',
            'check_out' => '2024-06-22',
            'cant_adults' => 2,
            'cant_infants' => 0,
            'status_payment' => 1,
            'id_user_reservation' => $userReservations[5]->id,
            'id_room' => 6,  // Assuming room 6 exists
        ]);

        $reservation7 = Reservation::create([
            'check_in' => '2024-07-10',
            'check_out' => '2024-07-12',
            'cant_adults' => 1,
            'cant_infants' => 0,
            'status_payment' => 0,
            'id_user_reservation' => $userReservations[6]->id,
            'id_room' => 7,  // Assuming room 7 exists
        ]);

        $reservation8 = Reservation::create([
            'check_in' => '2024-08-01',
            'check_out' => '2024-08-04',
            'cant_adults' => 5,
            'cant_infants' => 3,
            'status_payment' => 1,
            'id_user_reservation' => $userReservations[7]->id,
            'id_room' => 8,  // Assuming room 8 exists
        ]);

        $reservation9 = Reservation::create([
            'check_in' => '2024-09-10',
            'check_out' => '2024-09-15',
            'cant_adults' => 4,
            'cant_infants' => 0,
            'status_payment' => 0,
            'id_user_reservation' => $userReservations[8]->id,
            'id_room' => 9,  // Assuming room 9 exists
        ]);

        $reservation10 = Reservation::create([
            'check_in' => '2024-10-05',
            'check_out' => '2024-10-10',
            'cant_adults' => 3,
            'cant_infants' => 1,
            'status_payment' => 1,
            'id_user_reservation' => $userReservations[9]->id,
            'id_room' => 10,  // Assuming room 10 exists
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

        $buy3 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(2)->first()->id,
            'id_reservation' => $reservation3->id,
            'id_user' => $users[2]->id,
        ]);

        $buy4 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(3)->first()->id,
            'id_reservation' => $reservation4->id,
            'id_user' => $users[3]->id,
        ]);

        $buy5 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(4)->first()->id,
            'id_reservation' => $reservation5->id,
            'id_user' => $users[4]->id,
        ]);

        $buy6 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(5)->first()->id,
            'id_reservation' => $reservation6->id,
            'id_user' => $users[5]->id,
        ]);

        $buy7 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(6)->first()->id,
            'id_reservation' => $reservation7->id,
            'id_user' => $users[6]->id,
        ]);

        $buy8 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(7)->first()->id,
            'id_reservation' => $reservation8->id,
            'id_user' => $users[7]->id,
        ]);

        $buy9 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(8)->first()->id,
            'id_reservation' => $reservation9->id,
            'id_user' => $users[8]->id,
        ]);

        $buy10 = Buy::create([
            'id_passenger_fly' => PassengerFly::skip(9)->first()->id,
            'id_reservation' => $reservation10->id,
            'id_user' => $users[9]->id,
        ]);

        // Seed Paid
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

        Paid::create([
            'id_buy' => $buy3->id,
            'cantidad' => 300,
            'buyer' => 'Buyer 3',
        ]);

        Paid::create([
            'id_buy' => $buy4->id,
            'cantidad' => 400,
            'buyer' => 'Buyer 4',
        ]);

        Paid::create([
            'id_buy' => $buy5->id,
            'cantidad' => 500,
            'buyer' => 'Buyer 5',
        ]);

        Paid::create([
            'id_buy' => $buy6->id,
            'cantidad' => 600,
            'buyer' => 'Buyer 6',
        ]);

        Paid::create([
            'id_buy' => $buy7->id,
            'cantidad' => 700,
            'buyer' => 'Buyer 7',
        ]);

        Paid::create([
            'id_buy' => $buy8->id,
            'cantidad' => 800,
            'buyer' => 'Buyer 8',
        ]);

        Paid::create([
            'id_buy' => $buy9->id,
            'cantidad' => 900,
            'buyer' => 'Buyer 9',
        ]);

        Paid::create([
            'id_buy' => $buy10->id,
            'cantidad' => 1000,
            'buyer' => 'Buyer 10',
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

        Opinion::create([
            'name' => 'Opinion 3',
            'id_hotel' => $hotel3->id,
            'stars' => 4,
            'description' => 'Nice view!',
            'id_user' => $users[2]->id,
            'created_at' => now(),
        ]);

        Opinion::create([
            'name' => 'Opinion 4',
            'id_hotel' => $hotel4->id,
            'stars' => 3,
            'description' => 'Good service!',
            'id_user' => $users[3]->id,
            'created_at' => now(),
        ]);

        Opinion::create([
            'name' => 'Opinion 5',
            'id_hotel' => $hotel5->id,
            'stars' => 5,
            'description' => 'Excellent!',
            'id_user' => $users[4]->id,
            'created_at' => now(),
        ]);
    }
}
