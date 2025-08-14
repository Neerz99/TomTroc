<?php
// dev_selftest.php (à la racine du projet)
error_reporting(E_ALL); ini_set('display_errors', 1);
require __DIR__ . '/config/config.php';
require __DIR__ . '/config/autoload.php';

function say($ok, $msg) {
    echo $ok ? "✅ $msg<br>" : "❌ $msg<br>";
}

try {
    // 1) Managers joignables
    $uMgr = new UserManager();
    $bMgr = new BookManager();
    say(true, "Managers chargés");

    // 2) On a au moins 1 user pour ownerId
    $users = $uMgr->findAll();
    if (empty($users)) {
        say(false, "Aucun utilisateur en BDD. Crée un user puis relance.");
        exit;
    }
    $ownerId = (int)$users[0]['id'];

    // 3) Compte initial
    $countBefore = count($bMgr->findAll());

    // 4) CREATE
    $newId = $bMgr->create([
        'ownerId'     => $ownerId,
        'title'       => 'Selftest Book',
        'author'      => 'Self Tester',
        'imageUrl'    => null,
        'description' => 'Book créé par le selftest',
        'status'      => 'Disponible',
    ]);
    say($newId > 0, "Création livre (#$newId)");

    // 5) READ
    $book = $bMgr->find($newId);
    say($book && $book['title'] === 'Selftest Book', "Lecture OK");

    // 6) UPDATE
    $upd = $bMgr->update($newId, ['title' => 'Selftest Book v2', 'status' => 'Indisponible']);
    $book2 = $bMgr->find($newId);
    say($upd && $book2 && $book2['title'] === 'Selftest Book v2' && $book2['status'] === 'Indisponible', "Mise à jour OK");

    // 7) SEARCH
    $res = $bMgr->search('Selftest Book v2');
    $found = array_filter($res, fn($r) => (int)$r['id'] === (int)$newId);
    say(!empty($found), "Recherche OK");

    // 8) DELETE
    $del = $bMgr->delete($newId);
    $countAfter = count($bMgr->findAll());
    say($del && $countAfter === $countBefore, "Suppression OK (compte revenu)");

    echo "<hr>Fin du self-test.";
} catch (Throwable $e) {
    echo "💥 Exception : " . htmlspecialchars($e->getMessage());
}
