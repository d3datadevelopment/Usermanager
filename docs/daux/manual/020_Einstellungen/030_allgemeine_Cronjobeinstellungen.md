---
title: allgemeine Cronjobeinstellungen
---

Neben der manuell gestarteten Aufgabenausführung können diese auch automatisch über einen oder mehrere Cronjobs gestartet werden. Cronjobs werden auf dem Server eingerichtet und starten die Skriptausführung auch ohne Ihr Zutun.

Setzen Sie hier die Cronjob-Ausführung aktiv, wenn Sie die automatische Abarbeitung nutzen möchten.

Tragen Sie auch die Anzahl der Bestellungen ein, die pro Cronjob-Aufruf abgearbeitet werden dürfen. Die Menge ist begrenzt, da auch ein Cronjob nur eine vom Server vorgegebene Zeit zur Abarbeitung hat. Jede Bestellung benötigt ebenfalls etwas Zeit. Je nach Anzahl der aufgelaufenen Bestellungen und der auszuführenden Aufgaben sollte diese Anzahl justiert werden. Reicht die maximal nutzbare Anzahl der Kundenkonten nicht aus, lassen Sie den Cronjob einfach mehrmals laufen (z.B. alle 2 Stunden).

### Scriptaufruf über externe URL (abgekündigt für automatische Ausführung)

Das manuell ausführbare Cronjob-Skript können Sie (und jeder Andere auch) zur Einrichtung oder zur Kontrolle im Browser aufrufen. Neben den serverseitigen Sicherheitsmaßnahmen sollten Sie hier ein Passwort vergeben, mit dem das Skript ausschließlich gestartet werden kann. Ohne das Passwort verweigert der Kundenmanager seine Arbeit. So stellen Sie sicher, dass kein Unbefugter diese Ausführung startet. Dieses Script ist abgekündigt und sollte für die automatische Ausführung nicht mehr verwendet werden. Bitte verwenden Sie statt dessen das Konsolenscript.

### Scriptaufruf über Konsolenbefehl

Das automatisiert aufrufbare Cronscript lässt sich nur vom Server aus direkt aufrufen und benötigt daher kein Passwort. Rufen Sie `./vendor/bin/d3_usermanager_cron` im Shop-Root-Ordner auf, um weitere Informationen zu den Ausführungsmöglichkeiten zu erhalten. Neben dem Ausführungsstart können Sie sich darüber auch Statusinformation zu den Aufgaben oder der Installation abfragen.
