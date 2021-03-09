<!--
Realizzare nella pagina “esercizio??.php” uno script che scriva un
messaggio di saluto in base alla data e l’ora corrente (rilevata sul
server). Il messaggio dovrà avere la seguente struttura:
<Saluto>, oggi è <nome giorno> <num giorno> <nome mese> <anno>.
Sono le <ore>:<min>.
Arrivederci e <Saluto di commiato>.
dove:
• <saluto> varia, a seconda dell’ora del giorno, tra le stringhe
“Buon giorno”, “Buon pomeriggio”, “Buona sera” e “Buona notte”.
• <saluto di commiato> è la stringa “arrivederci e buona giornata” se
il giorno della settimana è un giorno lavorativo, oppure la stringa
“Arrivederci e buon weekend” se si tratta di un sabato o di una
domenica.
Facoltativo: per testare correttamente tutti i casi possibili, senza
dover cambiare manualmente la data del server, permettere all’utente di
inserire una data e un orario a piacere mediante il tag input di tipo
“datetime-local” e testare nuovamente il programma sulla data inserita.
-->


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customData">Inserisci una data personalizzata</label>
    <input type="datetime-local" id="customDate" name="customDate" value="<?php echo date('Y-m-d\TH:i:s'); ?>">
    <input type="submit" name="send" value="Invia">
</form>


<h1>
    <?php
    if (isset($_REQUEST['send'])) {
      $dateStr = date('Y-m-d\TH:i:s', strtotime($_POST['customDate']));
    } else{
      $dateStr = date('Y-m-d\TH:i:s');
    }

    $date = DateTime::createFromFormat('Y-m-d\TH:i:s', $dateStr);


    if ($date->format('H') >= date('5') and $date->format('H') < date('12')) {
        $greeting = 'Buongiorno';
    } elseif ($date->format('H') >= date('12') and $date->format('H') < date('17')) {
        $greeting = 'Buon pomeriggio';
    } elseif ($date->format('H') >= date('17') and $date->format('H') < date('22')) {
        $greeting = 'Buona sera';
    } else {
        $greeting = 'Buona notte';
    }


    if ($date->format('w') > 0 and $date->format('w') <= 5) {
        $farewell = "Arrivederci e buona giornata";
    } else {
        $farewell = "Arrivederci e buon weekend";
    }

    echo "$greeting oggi e' " . $date->format('l') . " " . $date->format('d') . " " . $date->format('F') . " " .
        $date->format('Y') . ".<br>Sono le ore " . $date->format('H:i');
    ?>
</h1>
</body>
</html>
