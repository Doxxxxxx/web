<?php
$printable = getpost_variable('printable');
if (is_hr($_SESSION['userlogin'])) {
    $home = 'hr/hr_index.php';
} elseif (is_resp($_SESSION['userlogin'])) {
    $home = 'responsable/resp_index.php';
} else {
    $home = 'utilisateur/user_index.php';
}

//user mode
$user_mode = '';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
list(,$urn) = explode('/', $uri);
$adminActive = $userActive = $respActive = $hrActive = $calendarActive = $configActive = '';
switch ($urn) {
    case "utilisateur":
        $user_mode = _('user');
        $userActive = 'active';
        break;
    case "admin":
        $user_mode = _('button_admin_mode');
        $adminActive = 'active';
        break;
    case "config":
        $user_mode = _('button_config_mode');
        $configActive = 'active';
        break;
    case "responsable":
        $user_mode = _('button_responsable_mode');
        $respActive = 'active';
        break;
    case "hr":
        $hrActive = _('button_hr_mode');
        $hrActive = 'active';
        break;
    default :
        $calendarActive = _('button_calendar');
        $calendarActive = 'active';
}
$onglet = getpost_variable('onglet');

function sousmenuAdmin()
{
    return '<a class="secondary" href="' . ROOT_PATH . 'admin/db_sauve">Backup</a>';
}

function sousmenuConfiguration()
{
    return '<a class="secondary" href="' . ROOT_PATH . 'config/general">Config. générale</a>
    <a class="secondary" href="' . ROOT_PATH . 'config/type_absence">Type de congés</a>
    <a class="secondary" href="' . ROOT_PATH . 'config/index.php?onglet=mail">Mails</a>
    <a class="secondary" href="' . ROOT_PATH . 'config/index.php?onglet=logs">Journaux</a>';
}

function sousmenuHR()
{
    $config = new \App\Libraries\Configuration(\includes\SQL::singleton());
    $return = '<a class="secondary" href="' . ROOT_PATH . 'hr/page_principale">Utilisateurs</a>
    <a class="secondary" href="' . ROOT_PATH . 'hr/hr_index.php?onglet=liste_groupe">Groupes</a>';

    if ($config->canUserSaisieDemande()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'hr/hr_index.php?onglet=traitement_demandes">Validation de congés</a>';
    }
    $return .= '<a class="secondary" href="' . ROOT_PATH . 'hr/hr_index.php?onglet=ajout_conges">Crédit de congés</a>
    <a class="secondary" href="' . ROOT_PATH . 'hr/jours_chomes">Jours fériés</a>
    <a class="secondary" href="' . ROOT_PATH . 'hr/hr_index.php?onglet=cloture_year">Exercices</a>
    <a class="secondary" href="' . ROOT_PATH . 'hr/hr_index.php?onglet=liste_planning">Plannings</a>
    <a class="secondary" href="' . ROOT_PATH . 'hr/hr_jours_fermeture.php">Jours de fermeture</a>';

    return $return;
}

function sousmenuResponsable()
{
    $config = new \App\Libraries\Configuration(\includes\SQL::singleton());
    $return = '<a class="secondary" href="' . ROOT_PATH . 'responsable/resp_index.php">Page principale</a>';

    if ($config->canUserSaisieDemande()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'responsable/resp_index.php?onglet=traitement_demandes">Validation de congés</a>';
    }

    if ($config->isHeuresAutorise()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'responsable/resp_index.php?onglet=traitement_heures_additionnelles">Validation d\'heures additionnelles</a>
        <a class="secondary" href="' . ROOT_PATH . 'responsable/resp_index.php?onglet=traitement_heures_repos">Validation d\'heures de repos</a>';
    }

    if ($config->canResponsableAjouteConges()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'responsable/resp_index.php?onglet=ajout_conges">Ajout de congés</a>';
    }

    if ($config->canResponsablesAssociatePlanning()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'responsable/resp_index.php?onglet=liste_planning">Plannings</a>';
    }

    return $return;
}

function sousmenuEmploye()
{
    $config = new \App\Libraries\Configuration(\includes\SQL::singleton());
    $return = '';
    $return .= '<a class="secondary" href="' . ROOT_PATH . 'utilisateur/user_index.php">Congés</a>';

    if ($config->canUserEchangeRTT()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'utilisateur/user_index.php?onglet=echange_jour_absence">Échange de jours</a>';
    }

    if ($config->isHeuresAutorise()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'utilisateur/user_index.php?onglet=liste_heure_repos">Heures de repos</a>';
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'utilisateur/user_index.php?onglet=liste_heure_additionnelle">Heures additionnelles</a>';
    }

    if ($config->canUserChangePassword()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'utilisateur/user_index.php?onglet=changer_mot_de_passe">Changer mot de passe</a>';
    }
    if ($config->canEditPapier()) {
        $return .= '<a class="secondary" href="' . ROOT_PATH . 'edition/edit_user.php">Édition papier</a>';
    }

    return $return;
}

include_once 'header.php';
?>
    <body id="top" class="connected <?= ($printable) ? 'printable' : '' ?>">
        <aside id="toolbar">
            <header class="main-header">
                <i class="icon-ellipsis-vertical toolbar-toggle"></i>
                <div class="brand"><a href="<?= ROOT_PATH . $home ?>" title="Accueil"><img src="<?= IMG_PATH ?>Libertempo64.png" alt="Libertempo"></a></div>
            </header>
            <div class="tools">
                <div class="primary profil-info">
                    <i class="fa fa-smile-o"></i>
                    <?= \App\ProtoControllers\Utilisateur::getNomComplet($_SESSION['u_prenom'], $_SESSION['u_nom'], true) ?>
                </div>
				<?php if (is_admin($_SESSION['userlogin'])): ?>
                <a class="primary <?= $adminActive ?>" href="<?= ROOT_PATH ?>admin/db_sauve" <?php print ($urn == 'admin') ? 'active' : '' ;?>>
                    <i class="fa fa-bolt"></i><?= _('button_admin_mode');?>
				</a>
                <?php if ($urn == 'admin') : ?>
                <?= sousmenuAdmin(); ?>
                <?php endif; ?>
                <a class="primary <?= $configActive ?>" href="<?= ROOT_PATH ?>config/general" <?php print ($urn == 'config') ? 'active' : '' ;?>>
                    <i class="fa fa-cog"></i><?= _('Configuration');?>
				</a>
                <?php if ($urn == 'config') : ?>
                <?= sousmenuConfiguration(); ?>
                <?php endif; ?>
				<?php endif; ?>
				<?php if (is_hr($_SESSION['userlogin'])): ?>
                <a class="primary <?= $hrActive ?>" href="<?= ROOT_PATH ?>hr/hr_index.php" <?php print ($urn == 'hr') ? 'active' : '' ;?>>
                    <i class="fa fa-sitemap"></i><?= _('button_hr_mode');?>
				</a>
                <?php if ($urn == 'hr') : ?>
                    <?= sousmenuHR(); ?>
                <?php endif; ?>
				<?php endif; ?>
				<?php if (is_resp($_SESSION['userlogin'])): ?>
                <a class="primary <?= $respActive ?>" href="<?= ROOT_PATH ?>responsable/resp_index.php" <?php print ($urn == 'responsable') ? 'active' : '' ;?>>
                    <i class="fa fa-users"></i><?= _('button_responsable_mode');?>
				</a>
                <?php if ($urn == 'responsable') : ?>
                    <?= sousmenuResponsable(); ?>
                <?php endif; ?>
				<?php endif; ?>
                <a class="primary <?= $userActive ?>" href="<?= ROOT_PATH ?>utilisateur/user_index.php" <?php print ($urn == 'utilisateur') ? 'active' : '' ;?>>
                    <i class="fa fa-user"></i><?= _('user') ?>
                </a>
                <?php if ($urn == 'utilisateur') : ?>
                    <?= sousmenuEmploye(); ?>
                <?php endif; ?>
                <?php if('active' === $calendarActive || $urn=='utilisateur' || $urn=='responsable' || in_array($urn, ['hr', 'admin', 'config'])): ?>
                <a class="primary <?= $calendarActive ?>" href="<?= ROOT_PATH ?>calendrier.php">
                    <i class="fa fa-calendar"></i><?= _('button_calendar') ?>
                </a>
                <?php endif; ?>
                <a id="deconnexion" class="primary" href="<?= ROOT_PATH ?>deconnexion.php">
                    <i class="fa fa-sign-out"></i><?= _('button_deconnect') ?>
                </a>
            </div>
        </aside>
        <section id="content">
            <section class="vbox">
                <section id="scrollable">
                    <div class="wrapper bg-white">
