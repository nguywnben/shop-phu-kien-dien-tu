<?php

require_once "header.php";
require_once "layouts/sidebar.php";

?>

        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fixed w-full h-screen z-9 bg-gray-900/50"></div>
            <?php require_once "layouts/header.php"; ?>
            <?php require_once "modules/user/edit.php"; ?>
        </div>

<?php

require_once "footer.php";

?>