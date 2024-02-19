<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
if (file_exists(ROOT_PATH.'/database/database.php')) {
    require ROOT_PATH.'/database/database.php';
} else {
    die('duhsbvjxkfgjis');
}
$db = getPDO();
$statement = $db->query('SELECT * FROM jiris WHERE starting_at < CURRENT_TIMESTAMP');
$upcoming_jiris = $statement->fetchALL();
$statement = $db->query('SELECT * FROM jiris WHERE starting_at > CURRENT_TIMESTAMP');
$passed_jiris = $statement->fetchALL();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jiris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="flex flex-col-reverse gap-4 container mx-auto">
    <main class="flex flex-col gap-4">
        <h1>
            Les Jiris
        </h1>
        <section>
            <h2>
                Jiris à venir
            </h2>
            <?php if (count($upcoming_jiris) > 0): ?>
                <ol>
                    <?php foreach ($upcoming_jiris as $jiri): ?>
                        <li>
                            <a class="text-blue-500 underline"
                               href="/jiris/ <?= $jiri->id ?>"><?= $jiri->name ?></a>
                        </li>
                    <?php endforeach ?>
                </ol>
            <?php else: ?>
                <p>Il n'y a pas de jiris à venir</p>
            <?php endif ?>
        </section>
        <section>
            <h2>
                Jiris passés
            </h2>
            <?php if (count($passed_jiris) > 0): ?>
                <ol>
                    <?php foreach ($passed_jiris as $jiri): ?>
                        <li>
                            <a class="text-blue-500 underline" href="/jiris/<?= $jiri->id ?>"><?= $jiri->name ?></a>
                        </li>
                    <?php endforeach ?>
                </ol>
            <?php else: ?>
                <p>Il n'y a pas de jiris passés</p>
            <?php endif ?>
        </section>
    </main>
    <nav>
        <h2 class="sr-only">
            Navigation principale
        </h2>
        <ul class="flex gap-4">
            <li><a href="/jiris">Jiris</a></li>
            <li><a href="/contacts">Contacts</a></li>
            <li><a href="/projet">Projets</a></li>
        </ul>
    </nav>
</div>
</body>
</html>
