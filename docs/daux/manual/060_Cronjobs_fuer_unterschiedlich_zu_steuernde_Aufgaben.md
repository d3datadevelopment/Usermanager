---
title: Cronjobs für unterschiedlich zu steuernde Aufgaben
---

Neu angelegte Aufgaben oder Aufgaben, denen Sie keine spezielle Cronjob-ID zugewiesen haben, erhalten standardmäßig immer die Cronjob-ID "0" (Null). Noch nicht zugeordnete oder neu angelegte Aufgaben können Sie gesamt über diese Cronjob-ID steuern. Hierfür können Sie mit den in den Modul-Grundeinstellungen angezeigten Daten einen Cronjob einrichten, der diese Aufgaben automatisch ausführt.

Häufig ist es jedoch der Fall, dass bestimmte Aufgaben nur zu besonderen Zeiten gestartet werden sollen. Beispiele sind:

- Erstellen von Auswertungen nur einmal im Quartal oder
- Marketingaktionen immer zu Beginn eines jeden Monats oder
- Geburtstagsglückwünsche immer vormittags statt nachts

Weisen Sie dann diesen speziellen Aufgaben jeweils eine eigene Cronjob-ID zu. Diese kann eine beliebige Zahl zwischen 1 und 99 sein. Verwenden mehrere Aufgaben dieselben Ausführungszeiten und Intervalle, können Sie diese durch Vergabe der gleichen Cronjob-ID auch zu einer Ausführungsgruppe zusammenfassen. Für diese Gruppe brauchen Sie nur einen gemeinsamen Cronjob einrichten.

Sobald Sie die Cronjob-ID an der Aufgabe gespeichert haben, werden Ihnen in den Grundeinstellungen des Moduls alle Informationen gezeigt, die Sie für die Einrichtung dieses zusätzlichen Cronjobs benötigen. An diesem Cronjob können Sie nun auch die neuen Ausführungszeiten direkt einstellen. Sofern Ihr Provider dies erfordert, legen Sie für jeden Cronjob eine separate .sh-Datei an (siehe [Aufgaben automatisch ausführen](050_Aufgaben_automatisch_ausfuehren.md)).

Vorherige Modulversionen verwendeten noch keine Cronjob-ID. Wird der Cronjob ohne ID aufgerufen, verwendet dieser automatisch die ID "0" (Null). Eine Umarbeitung der bisherigen Einstellungen ist nicht nötig.
