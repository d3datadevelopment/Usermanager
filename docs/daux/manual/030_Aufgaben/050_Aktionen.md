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
