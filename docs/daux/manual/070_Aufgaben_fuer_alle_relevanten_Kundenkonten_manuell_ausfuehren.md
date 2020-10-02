---
title: Aufgaben für alle relevanten Konten manuell ausführen
---

Die Adressen für einen manuellen Start der Aufgaben finden Sie in den Einstellungen des Kundenmanagers (Klappmenü [ Cronjobeinstellungen für... ]). Die Adresse unter `externer Link` kann zum manuellen Starten verwendet werden. Die Links sind immer für eine spezielle Cronjob-ID gültig. Alle Aufgaben mit dieser ID werden dann gleichzeitig gestartet.

Möchten Sie nur eine spezielle Aufgabe starten, vergeben Sie dieser eine eindeutige Cronjob-ID. Sie erhalten dann in den Einstellungen einen speziellen Link nur für diese ID. Weitere Informationen zur Verwendung der Cronjob-IDs sind im Kapitel [Cronjobeinstellungen für Cronjob-ID X](020_Einstellungen/040_Cronjobeinstellungen_fuer_Cronjob-ID.md) beschrieben.

Beachten Sie bitte, dass die Aufgaben in einem Durchlauf bearbeitet werden. Cronjobs haben im Regelfall mehr Ressourcen (Laufzeit, Speicher, ...) zur Verfügung, als Browseraufrufe. Sind die auszuführenden Aufgaben sehr umfangreich, kann es beim manuellen Aufruf unter Umständen zu Abbrüchen führen, wo der Cronjob sauber durchlaufen würde.
