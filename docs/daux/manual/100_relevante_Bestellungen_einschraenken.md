---
title: Bestellungen mit globaler Einstellung einschränken
---

Neben den aufgabenspezifischen Bedingungen können die Kundenkonten auch global eingestellt werden. Das kann sinnvoll sein, wenn z.B. in einem Entwicklungsshop nur alle Kundenkonten ab einem bestimmten Datum oder einer bestimmten Kundennummer verarbeitet werden sollen.

Seiten Sie dann in der Datei `config.inc.php` den folgenden Eintrag:

```
$this->d3UserManagerBasicRestrictions = array(
    '[shopId]'  => array(
        '[feldname_1]'     => '[feldwert_1]',
        '[feldname_2]'     => '[feldwert_2]'
);
```

Als 1. Indexname geben Sie die ID des Shopmandanten, als 2. Indexname das zu filternde Feld der Datenbanktabelle `oxuser` an. Der dahinter stehende Wert ist die Einstellung, bis zu der Kundenkonten ignoriert werden. In diesem Fall werden nur Konten ab dem Jahr 2020 sowie mit Kundennummer höher als 12 berücksichtigt.
Alle Einträge werden mit UND verknüpft, müssen also gleichzeitig gültig sein. Sie können Einträge für mehrere Shops und mehrere Felder konfigurieren.

Beispiel:

```
$this->d3UserManagerBasicRestrictions = array(
    '1' => array(
        'oxcustnr'     => '12',
        'oxregister'   => '2019-12-31'
    )
);
```

Bitte achten Sie darauf, ein gültiges Feld der `oxuser`-Tabelle anzugeben. Verwenden Sie dafür bitte kein Sprachpräfix.
