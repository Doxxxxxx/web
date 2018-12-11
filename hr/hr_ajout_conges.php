<?php
defined( '_PHP_CONGES' ) or die( 'Restricted access' );
$tab_type_cong = recup_tableau_types_conges();

echo \hr\Fonctions::pageAjoutCongesModule($tab_type_cong);
