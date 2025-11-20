<?php

require_once "header.php";

$array = [
    "components/layouts/header.php",
    "components/home/home.php",
    "components/home/categories.php",
    "components/home/products.php",
    "components/home/deals.php",
    "components/home/new-arrivals.php",
    "components/home/showcase.php",
    "components/layouts/newsletter.php",
    "components/layouts/footer.php"
];

foreach ($array as $element) {
    require_once($element);
}

require_once "footer.php";

?>