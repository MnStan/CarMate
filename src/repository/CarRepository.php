<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/CarInfo.php';
require_once __DIR__ . '/../controllers/SessionController.php';

class CarRepository extends Repository
{
    private $sessionController;

    public function __construct()
    {
        parent::__construct();
        $this->sessionController = new SessionController();
    }
    public function getCarsByCity(string $cityName = null): ?array
    {
        if ($cityName) {
            $stmt = $this->database->connect()->prepare('
                SELECT DISTINCT c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
                FROM car c
                JOIN car_info ci ON c.car_info_id = ci.car_info_id
                JOIN car_city cc ON c.car_id = cc.car_id
                JOIN city ON cc.city_id = city.city_id
                WHERE city.name = :cityName
                ORDER BY c.car_id DESC
            ');
    
            $stmt->bindParam(':cityName', $cityName, PDO::PARAM_STR);
        } else {
            $stmt = $this->database->connect()->prepare('
                SELECT DISTINCT c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
                FROM car c
                JOIN car_info ci ON c.car_info_id = ci.car_info_id
                JOIN car_city cc ON c.car_id = cc.car_id
                JOIN city ON cc.city_id = city.city_id
                ORDER BY c.car_id DESC
            ');
        }
    
        $stmt->execute();
    
        $carsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cars = [];
    
        foreach ($carsData as $carData) {
            $photos = $this->getPhotosByCarInfoId(intval($carData['car_info_id']));
    
            $carInfo = new CarInfo(
                $carData['car_info_id'],
                $carData['name'],
                $carData['description'],
                $carData['directory_url'],
                $carData['avatar_url'],
                $photos
            );
    
            $car = new Car(
                $carData['car_id'],
                $carData['user_id'],
                $carData['car_info_id'],
                $carData['active'],
                $carData['creation_date'],
                $carInfo,
                $carData['city_id'],
                $carData['city_name']
            );
    
            $cars[] = $car;
        }
    
        if (!$cars) {
            return null;
        }
    
        return $cars;
    }
    
    public function getAllCars(): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
            FROM car c
            JOIN car_info ci ON c.car_info_id = ci.car_info_id
            JOIN car_city cc ON c.car_id = cc.car_id
            JOIN city ON cc.city_id = city.city_id
            ORDER BY c.car_id DESC
        ');
    
        $stmt->execute();
    
        $carsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cars = [];
        $seenCarIds = [];
    
        foreach ($carsData as $carData) {
            $carId = $carData['car_id'];
            if (!in_array($carId, $seenCarIds)) {
                $photos = $this->getPhotosByCarInfoId(intval($carData['car_info_id']));
    
                $carInfo = new CarInfo(
                    $carData['car_info_id'],
                    $carData['name'],
                    $carData['description'],
                    $carData['directory_url'],
                    $carData['avatar_url'],
                    $photos
                );
    
                $car = new Car(
                    $carData['car_id'],
                    $carData['user_id'],
                    $carData['car_info_id'],
                    $carData['active'],
                    $carData['creation_date'],
                    $carInfo,
                    $carData['city_id'],
                    $carData['city_name']
                );
    
                $cars[] = $car;
                $seenCarIds[] = $carId;
            }
        }
    
        if (!$cars) {
            return null;
        }
    
        return $cars;
    }
    



    public function getCarById(string $carId): ?Car
    {
        $stmt = $this->database->connect()->prepare('
            SELECT c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
            FROM car c
            JOIN car_info ci ON c.car_info_id = ci.car_info_id
            JOIN car_city cc ON c.car_id = cc.car_id
            JOIN city ON cc.city_id = city.city_id
            WHERE c.car_id = :carId
        ');
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->execute();

        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$car) {
            return null;
        }

        $photos = $this->getPhotosByCarInfoId(intval($car['car_info_id']));

        $carInfo = new CarInfo(
            $car['car_info_id'],
            $car['name'],
            $car['description'],
            $car['directory_url'],
            $car['avatar_url'],
            $photos
        );

        return new Car(
            $car['car_id'],
            $car['user_id'],
            $car['car_info_id'],
            $car['active'],
            $car['creation_date'],
            $carInfo,
            $car['city_id'],
            $car['city_name']
        );
    }

    public function getPhotosByCarInfoId(int $carInfoId): array
    {
        $output = [];

        $stmt = $this->database->connect()->prepare('
            SELECT photo_id, photo_url 
            FROM photos 
            WHERE car_info_id = :carInfoId
        ');
        $stmt->bindParam(':carInfoId', $carInfoId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCar(string $name, string $description, int $cityId, string $directoryUrl, string $avatarUrl, array $photos): void
    {
        $carId = $this->getNextId('car', 'car_id');
        $carInfoId = $this->getNextId('car_info', 'car_info_id');
        $userId = $this->sessionController->unserializeUser()->getUserID();
        $creationDate = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO car (car_id, user_id, car_info_id, active, creation_date) VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $carId,
            $userId,
            $carInfoId,
            true,
            $creationDate->format('Y-m-d')
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO car_info (car_info_id, name, description, directory_url, avatar_url) VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $carInfoId,
            $name,
            $description,
            $directoryUrl,
            $avatarUrl
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO car_city (car_id, city_id) VALUES (?, ?)
        ');

        $stmt->execute([
            $carId,
            $cityId
        ]);

        foreach ($photos as $photo) {
            $photoId = $this->getNextId('photos', 'photo_id');
            $stmt = $this->database->connect()->prepare('
                INSERT INTO photos (photo_id, car_info_id, photo_url) VALUES (?, ?, ?)
            ');

            $stmt->execute([
                $photoId,
                $carInfoId,
                $photo
            ]);
        }
    }

    public function searchCarsByModelOrCity(string $searchTerm): ?array
    {
        $searchTerm = '%' . $searchTerm . '%';
    
        $stmtCity = $this->database->connect()->prepare('
            SELECT DISTINCT ON (c.car_id) c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
            FROM car c
            JOIN car_info ci ON c.car_info_id = ci.car_info_id
            JOIN car_city cc ON c.car_id = cc.car_id
            JOIN city ON cc.city_id = city.city_id
            WHERE city.name LIKE :searchTerm
            ORDER BY c.car_id, ci.name ASC
        ');
    
        $stmtCity->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmtCity->execute();
    
        $carsCityData = $stmtCity->fetchAll(PDO::FETCH_ASSOC);
        $carsCity = [];
    
        foreach ($carsCityData as $carData) {
            $photos = $this->getPhotosByCarInfoId(intval($carData['car_info_id']));
    
            $carInfo = new CarInfo(
                $carData['car_info_id'],
                $carData['name'],
                $carData['description'],
                $carData['directory_url'],
                $carData['avatar_url'],
                $photos
            );
    
            $car = new Car(
                $carData['car_id'],
                $carData['user_id'],
                $carData['car_info_id'],
                $carData['active'],
                $carData['creation_date'],
                $carInfo,
                $carData['city_id'],
                $carData['city_name']
            );
    
            $carsCity[] = $car;
        }
    
        // Wyszukiwanie po nazwie pojazdu/ogłoszenia
        $stmtModel = $this->database->connect()->prepare('
            SELECT DISTINCT ON (c.car_id) c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
            FROM car c
            JOIN car_info ci ON c.car_info_id = ci.car_info_id
            JOIN car_city cc ON c.car_id = cc.car_id
            JOIN city ON cc.city_id = city.city_id
            WHERE ci.name LIKE :searchTerm
            ORDER BY c.car_id, ci.name ASC
        ');
    
        $stmtModel->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmtModel->execute();
    
        $carsModelData = $stmtModel->fetchAll(PDO::FETCH_ASSOC);
        $carsModel = [];
    
        foreach ($carsModelData as $carData) {
            $photos = $this->getPhotosByCarInfoId(intval($carData['car_info_id']));
    
            $carInfo = new CarInfo(
                $carData['car_info_id'],
                $carData['name'],
                $carData['description'],
                $carData['directory_url'],
                $carData['avatar_url'],
                $photos
            );
    
            $car = new Car(
                $carData['car_id'],
                $carData['user_id'],
                $carData['car_info_id'],
                $carData['active'],
                $carData['creation_date'],
                $carInfo,
                $carData['city_id'],
                $carData['city_name']
            );
    
            $carsModel[] = $car;
        }
    
        // Połącz wyniki zapytań
        $output = array_merge($carsCity, $carsModel);
    
        if (!$output) {
            return null;
        }
    
        return $output;
    }
    
}