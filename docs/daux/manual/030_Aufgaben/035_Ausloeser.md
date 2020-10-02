---
title: Auslöser
---

Hier stellen Sie ein, wann und wie die Augabe gestartet werden kann.

Sie haben die Wahl zwischen:

- zeitgesteuerter Cronjob

  Lassen Sie die Aufgabe immer zu vorab festgelegten Zeiten starten. Sie müssen sich dann um die Ausführung nicht kümmern.

  Der [ automatische Auführung über Cronjob möglich ]-Haken definiert, ob diese Aufgabe über die Cronjobs ausgeführt werden darf. 

  Der Einstellung der Cronjob-ID widmet sich das Kapitel [Cronjobs für unterschiedlich zu steuernde Aufgaben](../060_Cronjobs_fuer_unterschiedlich_zu_steuernde_Aufgaben.md) ausführlich.

  > [i] Beachten Sie bitte, das zusätzlich zu diesen Einstellungen ein passender Cronjob auf Ihrem Server eingerichtet sein muss. Der Ablauf der Einrichtung ist von Ihrem Provider abhängig. Bei Fragen kontaktieren Sie bitte uns oder Ihren Provider.
  
  Mit [ Bearbeitete Kundenkonten nicht als erledigt markieren ] wird nach erfolgreichem Abschluss der Aufgabe diese auch für die nächste Ausführung erneut vorgemerkt. Verwenden Sie Ihre Aufgabe als Wiedervorlage, setzen Sie diesen Haken. Alle zutreffenden Kundenkonten (auch die aktuell bearbeiteten) werden beim nächsten Aufruf erneut bearbeitet. Ansonsten werden die bearbeiteten Kundenkonten mit dieser Aufgabe nicht noch einmal behandelt.

  Speziell für die Aufgaben ohne Bearbeitungsmarkierung kann der regelmäßige (z.B. tägliche) Aufruf zu häufig sein. Stellen Sie dann den Wiedervorlagezeitraum ein, wann die Aufgabe erneut ausgeführt werden soll.

  > [!]  Beachten Sie bitte: Die Aufgaben können unabhängig des eingestellten Zeitraums nur ausgeführt werden, wenn auch das Cronjob-Skript gestartet wird. Ansonsten bleibt die Aufgabe bis zum nächsten Cronjob unbearbeitet liegen.

- manuelle Ausführung

  Alle Aufgaben können auch manuell für jede Bestellung ausgeführt werden. Ob dies für die Aufgabe sinnvoll erscheint, können Sie mit dem Haken [ manuelle Ausführung an Kundenkonto möglich ] festlegen. Haben Sie den Haken gesetzt, wird diese Aufgabe an den Kundenkonten (im Admin unter [ Benutzer verwalten ] -> [ Benutzer ] -> [ D3 Kundenmanager ]) angezeigt. (siehe auch [Aufgaben manuell ausführen](../070_Aufgaben_fuer_alle_relevanten_Kundenkonten_manuell_ausfuehren.md)).
  
  Mit "Aufgabe wird nur bei Kundenkonten angeboten, bei denen die eingestellten Bedingungen erfüllt sind" können Sie entscheiden, ob die Aufgabe an jedem Kundenkonto angezeigt werden soll oder nur an Konten, die die eingestellten Bedingungen erfüllen.

- nach dem Abschluss der Bestellung durch den Kunden

  Die Aufgabe wird dann ausgeführt, wenn der Kunde seine Bestellung im Bestellschritt 4 abgesendet hat und diese vom angelegt wurde. Die Aufgabe führt dann nur das Kundenkonte dieser einen Bestellung aus, wenn dieses die eingestellten Bedingungen erfüllt.
  
  > [i] Technisch gesehen erfolgt die Bearbeitung der Bestellung nach Ausführung von \OxidEsales\Eshop\Application\Model\Order::finalizeOrder()
  
- nach jedem Speichern des Kundenkontos

  Die Ausführung der Aufgabe erfolgt immer dann, wenn ein Kundenkonto gespeichert wird. Je nachdem, ob das bearbeitet Kundenkonto als "erledigt" markiert wird, erfolgt (k)eine erneute Bearbeitung beim nächsten Speichern.
  
  > [i] Technisch gesehen erfolgt die Bearbeitung der Bestellung nach Ausführung von \OxidEsales\Eshop\Application\Model\User::save()

Aktive Auslöser werden für die schnelle Übersicht mit einen grünen Häkchen markiert.

An jedem Auslöser können Sie die Ausführung einer Vorabsriptes und / oder eines Danachscriptes einstellen, welches vorbereitende oder nachbereitende Arbeiten ausführt (nur verfügbar in der [Premium-Edition](../../editions/010_Editionen.md).

Speichern Sie gesetzte Einstellungen ab.
