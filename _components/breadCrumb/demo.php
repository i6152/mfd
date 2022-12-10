<?php
function demoBreadCrumb(){
    global $breadCrumb;
    ?>
    <div class="container px-3 py-2 mb-2" style="border-bottom: 1px dashed;">
        <?php
        # echo '<pre>';
        print_r($breadCrumb);
        ?>
    </div>
    <?php
}