<?php
namespace phorkie;
/**
 * Show paste creation form
 *
 * Elements:
 * - description
 * - file name (default: default.php)
 * - content
 *
 * Creates and redirects to display page
 */
$reqWritePermissions = true;
require_once 'www-header.php';

$repopo = new Repository_Post();
if ($repopo->process($_POST, $_SESSION)) {
    redirect($repopo->repo->getLink('display', null, true));
}

$phork = array(
    '1' => new File(null, null)
);
$db = new Database();
render(
    'new',
    array(
        'files'       => $phork,
        'description' => '',
        'htmlhelper'  => new HtmlHelper(),
        'recents'     => $db->getSearch()->listAll(0, 5, 'modate', 'desc'),
        'dh'          => new \Date_HumanDiff(),
    )
);
?>
