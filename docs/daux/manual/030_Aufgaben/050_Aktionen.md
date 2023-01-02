---
title: Aktionen
---

Haben Sie die Bedingungen gesetzt, setzen Sie nun die Aktionen, die ausschließlich auf die gefundenen Kundenkonten angewendet werden.

Auch hier verzichten wir in diesem Handbuch auf die Auflistung der Aktionen, da diese normalerweise selbsterklärend sind. Im Folgenden sind nun Besonderheiten aufgeführt, auf die Sie speziell achten sollten:

Beachten Sie, dass die Aktion "Löschen von Konten" nicht rückgängig gemacht werden kann. Lassen Sie bei solchen Aktionen erst während eines Testzeitraums die Infomails zusenden, mit denen Sie prüfen können, ob die Löschaktionen auch die richtigen Bestellungen betreffen. Wir übernehmen keine Gewährleistung bei Datenverlust auf Grund von unzureichend geprüften Aufgaben.

Alle Aktionen, die sich auf Währungsmengen beziehen (z.B. Versandkosten oder Rabatte), verwenden die Angabe immer in der Shop-Hauptwährung. Rechnen Sie Angaben in Fremdwährung für die Aktionen daher bitte immer um.

Geben Sie bei Veränderung eines Freitextfeldes als Feldname immer das Stammfeld an. Die Angabe des sprachabhängigen Suffix (z.B. ..._1) wird vom Modul bei Bedarf selbst
vorgenommen.

Beim Versand von Mails können Sie als Quelle Ihres Mailinhalts CMS-Bausteine aus Ihrem Shop oder komplette Templatedateien verwenden. In beiden Möglichkeiten haben Sie die folgenden Variablen zur Verfügung, um die Mail zu individualisieren:

| Variable			| Inhalt  																												|
|-------------------|-----------------------------------------------------------------------------------------------------------------------|
| $oShop  			| enthält das Shop-Objekt und alle seine Möglichkeiten  																|
| $shop  			| enthält das Shop-Objekt und alle seine Möglichkeiten  																|
| $oViewConf		| enthält das Shop-Objekt und alle seine Möglichkeiten  																|
| $oOrder			| enthält das Bestellungen-Objekt und alle seine Möglichkeiten  														|
| $order			| enthält das Bestellungen-Objekt und alle seine Möglichkeiten  														|
| $oUser			| enthält das Benutzer-Objekt und alle seine Möglichkeiten  															|
| $user				| enthält das Benutzer-Objekt und alle seine Möglichkeiten  															|
| $shopTemplateDir 	| enthält das Verzeichnis zum Template  																				|
| $charset			| enthält den Zeichensatz für die Mail  																				|
| $basket			| enthält das Warenkorb-Objekt und alle seine Möglichkeiten (erfordert, dass alle Artikel noch im Stamm vorhanden sind)	|
| $payment			| enthält das Bezahlarten-Objekt und alle seine Möglichkeiten 															|
| $oDelSet			| enthält das Versandarten-Objekt und alle seine Möglichkeiten															|
| $currency			| enthält das Währungs-Objekt und alle seine Möglichkeiten																|

Legen Sie die Templatedateien im auszuwählenden Ordner ab.

### "Push-Benachrichtigung senden"
Hierbei wird eine Benachrichtigung an eine eigene Schnittstelle oder einen Dienst (z.B. [IFTTT](https://ifttt.com/) oder [Automate.io](https://automate.io/)) gesendet, der damit weitere Aktionen auslösen kann. Welche Aktionen möglich sind, hängt vom verwendeten Dienst ab.

Bei Push-Benachrichtigungen können der Benachrichtung Daten mitgegeben werden, die vom benachrichtigten Dienst ausgewertet werden können. Der mögliche Funktionsumfang ist so groß, dass wir nur ein Beispiel mitgeben. Möchten Sie die Daten über den konfigurierbaren Umfang hinaus verändern, stehen Ihnen dazu diese Funktionen zur Verfügung, die modular überladen werden können.

| Element                        | Klasse                                                                               | Methode             | Parameter | erwarteter Rückgabetyp |
|--------------------------------|--------------------------------------------------------------------------------------|---------------------|-----------|------------------------|
| Headerangaben                  | D3\Usermanager\Application\Model\Actions\d3usermanager_action_sendpushnotification   | getHeaders          | keine     | Array                  |
| Nachrichtenbody                | D3\Usermanager\Application\Model\Actions\d3usermanager_action_sendpushnotification   | getSubmittedBody    | keine     | String                 |
| alle zu übertragenden Optionen | D3\Usermanager\Application\Model\Actions\d3usermanager_action_sendpushnotification   | getSubmittedOptions | keine     | Array                  |
| Übertragungsmethode            | D3\Usermanager\Application\Model\Actions\d3usermanager_action_sendpushnotification   | getRequestMethod    | keine     | String                 |
| Zieladresse                    | D3\Usermanager\Application\Model\Actions\d3usermanager_action_sendpushnotification   | getRequestUrl       | keine     | String                 |

In den meisten Fällen wird das Anpassen des Nachrichtenbody ausreichen. Im Standard werden dort benötigte Felder als json encodetes Array zurückgegeben.

GET-Parameter innerhalb der Anfrage-URL können mit Platzhaltern angepasst werden. Platzhaltervariablen werden in doppelte geschweifte Klammern gefasst "{{var1}}". Die verfügbaren Variablen sehen Sie am Hilfetext der URL im Adminbereich der Aktion.

Bei der Verwendung der POST-Übertragsmethode werden optionale GET-Parameter der URL automatisch an den schon bestehenden Nachrichtenbody angefügt.

Innerhalb der Methoden stehen folgende Objekte und deren Eigenschaften zur Verfügung:

| Aufruf                                                | Inhalt                                                                |
|-------------------------------------------------------|-----------------------------------------------------------------------|
| $this->getManager()                                   | enthält die Kundenmanager-Aufgabe und alle seine Möglichkeiten        |
| ...->getId()                                          | die eindeutige Identnummer                                            |
| ...->getFieldData('oxtitle')                          | den Aufgabentitel                                                     |
| ...->getFieldData('oxsort')                           | die Aufgabensortiernummer                                             |
| ...->getFieldData('d3_cronjobid')                     | die Cronjob-ID                                                        |
|                                                       |                                                                       |
| $this->getManager()->getCurrentItem()                 | enthält das Kundenobjekt und alle seine Möglichkeiten                 |

Benötigen Sie Unterstützung bei der Einrichtung, kontaktieren Sie uns bitte.
