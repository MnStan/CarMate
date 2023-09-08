<?php

require_once 'AppController.php';
require_once 'SessionController.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/CarInfo.php';
require_once __DIR__ . '/../repository/CarRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class CarController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];
    private $carRepository;
    private $userRepository;
    private $sessionController;

    public function __construct()
    {
        parent::__construct();
        $this->carRepository = new CarRepository();
        $this->userRepository = new UserRepository();
        $this->sessionController = new SessionController();
    }

    public function main($searchResults = [])
    {
        $cars = $searchResults;
        $main = [];
    
        if (!empty($cars)) {
            foreach ($cars as $car) {
                $owner = $this->userRepository->getUserById($car->getUserId());
                array_push($main, [$car, $owner]);
            }
        }
    
        $this->render('main', ['main' => $main]);
    }
    
    public function carInfo($query = '')
{
        $user = $this->sessionController->unserializeUser();

        if (!$user) {
            $this->redirectToLogin();
        }

        $defaultCityId = $user->getUserInfo()->getCityId();
        $defaultCityName = $user->getUserInfo()->getCityName();

        parse_str($query, $query);
        $carId = intval($query['id']);

        $car = $this->carRepository->getCarById($carId); 
        $owner = $this->userRepository->getUserById($car->getUserId()); 

        $this->render('carInfo', ['car' => $car, 'owner' => $owner, 'defaultCityId' => $defaultCityId, 'defaultCityName' => $defaultCityName]); 
}


    public function addCar()
    {
        $this->render('addCar');
    }

    public function getCarById($carId)
    {
        return $this->carRepository->getCarById($carId);
    }

    public function getCars($cityId)
    {
        return $this->carRepository->getCarsByCity($cityId);
    }

    public function addCarForm()
    {
        if (
            !(
                $this->isPost()
                && isset($_FILES['avatar'])
                && is_uploaded_file($_FILES['avatar']['tmp_name'])
                && $this->validateFile($_FILES['avatar'])
                && $this->validateTitle($_POST['title'])
            )
        ) {
            if (!$this->isPost()) {
                $this->messages[] = "Próba przesłania nie została dokonana przez formularz POST.";
            }
            if (!isset($_FILES['avatar']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                $this->messages[] = "Plik avatar nie został przesłany.";
            }
            if (!$this->validateFile($_FILES['avatar'])) {
                $this->messages[] = "Błąd walidacji pliku avatar.";
            }
            if (!$this->validateTitle($_POST['title'])) {
                $this->messages[] = "Błąd walidacji tytułu.";
            }
        }
        

        $folderName = $this->carRepository->generateID();
        $newPath = dirname(__DIR__) . self::UPLOAD_DIRECTORY . $folderName;
        mkdir($newPath);

        $avatarUrl = $this->carRepository->generateID() . '.' . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

        if (isset($_FILES['avatar']) && is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $newPath . '/' . $avatarUrl)) {
                $this->messages[] = "Zdjęcie zostało przesłane i zapisane pomyślnie";
            } else {
                $lastError = error_get_last();
                $this->messages[] = 'Błąd podczas zapisywania zdjęcia: ' . $lastError['message'];
            }
        } else {
            $this->messages[] = 'Błąd: Nieprawidłowe przesłane zdjęcie.';
        }
        

        $photos = [];
        if ($_FILES['photos']) {
            for ($i = 0; $i < count($_FILES['photos']['name']); $i++) {
                $tmp_name = $_FILES['photos']['tmp_name'][$i];
                $ext = pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
                $newName = $this->carRepository->generateID() . '.' . $ext;

                move_uploaded_file(
                    $tmp_name,
                    $newPath . '/' . $newName
                );

                array_push($photos, $newName);
            }
        }

        $this->carRepository->addCar(
            $_POST['title'],
            $_POST['description'],
            intval($_POST['city']),
            $folderName,
            $avatarUrl,
            $photos
        );

        return $this->redirectToHome();
    }

    private function validateFile($file): bool
    {
        if (!is_array($file)) {
            $this->messages[] = 'Nieprawidłowy plik lub brak pliku';
            return false;
        }
    
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'Plik jest za duży';
            return false;
        }
    
        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'Rozszerzenie pliku jest niedozwolone';
            return false;
        }
    
        return true;
    }
    

    private function validateTitle(string $title): bool
    {
        if (strlen($title) < 3) {
            $this->messages[] = 'Nazwa jest za krótka';
            return false;
        }

        if (strlen($title) > 50) {
            $this->messages[] = 'Nazwa jest za długa';
            return false;
        }

        return true;
    }

        public function searchCarsByModelOrCity($searchTerm)
{
    $searchTerm = '%' . $searchTerm . '%';
    $stmt = $this->database->connect()->prepare('
        SELECT DISTINCT c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
        FROM car c
        JOIN car_info ci ON c.car_info_id = ci.car_info_id
        JOIN car_city cc ON c.car_id = cc.car_id
        JOIN city ON cc.city_id = city.city_id
        WHERE ci.name LIKE :searchTerm OR city.name LIKE :searchTerm
        ORDER BY c.car_id DESC
    ');

    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();

    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$cars) {
        return null;
    }

    $output = [];

    foreach ($cars as $car) {
        $photos = $this->getPhotosByCarInfoId(intval($car['car_info_id']));

        $carInfo = new CarInfo(
            $car['car_info_id'],
            $car['name'],
            $car['description'],
            $car['directory_url'],
            $car['avatar_url'],
            $photos
        );

        $newCar = new Car(
            $car['car_id'],
            $car['user_id'],
            $car['car_info_id'],
            $car['active'],
            $car['creation_date'],
            $carInfo,
            $car['city_id'],
            $car['city_name']
        );

        array_push($output, $newCar);
    }

    return $output;
}

public function searchCars()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $searchTerm = $_POST['search'];
        $carRepository = new CarRepository();
        $cars = $carRepository->searchCarsByModelOrCity($searchTerm);

        // Przypisz wyniki wyszukiwania do zmiennej
        $searchResults = $cars;
        
        // Przekaz wyniki do widoku main.php
        include_once "public/views/main.php";
        exit();
    } else {
        echo "Invalid request method.";
    }
}

public function getCarsByCity($cityName)
{
    return $this->carRepository->getCarsByCity($cityName);
}

}
