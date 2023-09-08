<?php
$SessionController = new SessionController();
if ($SessionController::isLogged() === false) {
    $SessionController->redirectToLogin();
}

require_once "public/views/components/button.php";
require_once "public/views/components/rentInfoBean.php";

$image = 'public/img/photos/toyota.jpg';

$buttonArrayCarInfo = [
    'type' => 'submit',
    'id' => 'open-modal-button',
    'value' => 'umów jazdę próbną'
];

$closeModalButtonArray = [
    'type' => 'submit',
    'id'=> 'close-modal-button',
    'value' => 'zamknij'
];

$avatarUrl = 'public/uploads/' . $car->getCarInfo()->getDirectoryUrl() . '/' . $car->getCarInfo()->getAvatarUrl();
$photos = $car->getCarInfo()->getPhotos();
$photoUrls = [$avatarUrl];

foreach ($photos as $photoInfo) {
    $photoUrls[] = 'public/uploads/' . $car->getCarInfo()->getDirectoryUrl() . '/' . $photoInfo['photo_url'];
}
?>

<html lang="en">
<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Informacje</title>
</head>
<body>
    <?php include("public/views/components/navbar.php"); ?>
    <main class="container flex flex-center flex-column" style="gap: 1.5rem">
    <div class="car-photo-container flex-center flex-column" style="gap: 1.5rem">
        <div class="container flex flex-center" id="photo-container">
            <img src="<?= $avatarUrl; ?>" alt="Zdjecie Pojazdu" id="current-photo">
        </div>
        <div class="container flex flex-center flex row">
            <button id="prev-button" class="button drop-shadow-animate">Poprzednie zdjęcie</button>
            <button id="next-button" class="button drop-shadow-animate">Następne zdjęcie</button>
        </div>
    </div>
    <div class="rent-info container flex flex-center flex-column">
        <div class="rent-info-container">
            <h3>Właściciel</h3>
            <div class="info-info flex flex-row">
                <?php echo RentInfo($owner->getUserInfo()->getName()) ?>
                <?php echo RentInfo($owner->getUserInfo()->getAddress()); ?>
            </div>
            <h3>Informacje o samochodzie</h3>
            <div class="info-info flex flex-row">
                <?php echo RentInfo($car->getCarInfo()->getName()); ?>
                <?php echo RentInfo($car->getCarInfo()->getDescription()); ?>
            </div>
        </div>
    </div>
    <?php echo Button($buttonArrayCarInfo); ?>

    <div id="modal" class="modal">
        <div class="modal-content flex flex-center flex-column">
            <h2>Umów jazdę próbną</h2>
            <h3>Informacje o właścicielu</h3>
            <p><?php echo $owner->getUserInfo()->getName()?></p>
            <p><?php echo $owner->getUserInfo()->getCityName()?></p>
            <p><?php echo $owner->getUserInfo()->getPhone()?></p>
            <p><?php echo $owner->getUserInfo()->getAddress()?></p>
            <h3>Dziękujemy za skorzystanie z naszych usług!</h3>
            <?php echo Button($closeModalButtonArray) ?>
        </div>
    </div>

</main>
<script>
    const photoContainer = document.getElementById('photo-container');
    const currentPhoto = document.getElementById('current-photo');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const modal = document.getElementById('modal');
    const closeModalButton = document.getElementById('close-modal-button');
    const photoUrls = <?= json_encode($photoUrls); ?>;
    let currentPhotoIndex = 0;

    function showCurrentPhoto() {
        currentPhoto.src = photoUrls[currentPhotoIndex];
    }

    showCurrentPhoto();

    prevButton.addEventListener('click', () => {
        if (currentPhotoIndex > 0) {
            currentPhotoIndex--;
            showCurrentPhoto();
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentPhotoIndex < photoUrls.length - 1) {
            currentPhotoIndex++;
            showCurrentPhoto();
        }
    });

    const openModalButton = document.getElementById('open-modal-button');

    openModalButton.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    closeModalButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });
</script>
    <?php include('public/views/components/footer.php'); ?>
</body>
</html>
