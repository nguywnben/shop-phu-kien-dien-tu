<?php

require_once "header.php";

$array = [
    "components/layouts/header.php",
    "components/layouts/breadcrumb.php",
    "components/details/details.php",
    "components/details/details-tab.php",
    "components/details/products.php",
    "components/layouts/newsletter.php",
    "components/layouts/footer.php"
];

foreach ($array as $element) {
    require_once($element);
}

require_once "footer.php";

?>