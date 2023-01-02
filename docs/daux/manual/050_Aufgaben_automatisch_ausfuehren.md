---
title: Aufgaben automatisch ausführen
---

Richten Sie sich auf Ihrem Server einen oder mehrere Cronjobs ein, der den Link aus dem Einstellungsdialog enthält. Der Cronjob kann je nach Erfordernissen auch mehrfach am Tag ausgeführt werden. Dies ist hauptsächlich von der Anzahl der Kundenkonten und den angelegten Aufgaben Ihres Shops abhängig.

Sofern bei Ihrem Provider notwendig, binden Sie statt der PHP-Datei die gleichnamige SH- Datei als Cronjob-Skript ein. Ändern Sie den Inhalt der SH-Datei zuvor auf Ihre
Servereinstellungen.

Sie sollten unbedingt den Aufruf von .sh-Dateien per Browser verhindern, so dass kein Unbefugter diese Datei von außen aufrufen kann. Dazu erweitern Sie z.B. die .htaccess- Datei des Shops um folgende Zeilen:

```sh
<Files *.sh>
  order allow,deny
  deny from all
</Files>
```
