<?php
/*
 * dev 113 
 */
?>
<h1><?php echo $prospect->getNom(); ?></h1>
<p>
    <label> NIF : <?php echo $prospect->getNif(); ?> </label>
    <br>
    <label> STAT : <?php echo $prospect->getStat(); ?> </label>
    <br>
    <label> Email : <?php echo $prospect->getContact()->getEmail(); ?> </label>
    <br>
    <label> Telephone : <?php echo $prospect->getContact()->getTelephone(); ?> </label>
    <br>
    <label> Skype : <?php echo $prospect->getContact()->getSkype(); ?> </label> 
</p>
