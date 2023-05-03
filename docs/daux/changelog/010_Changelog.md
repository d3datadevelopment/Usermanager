---
title: Changelog
---

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://git.d3data.de/D3Private/Usermanager/compare/5.1.1.3...rel_5.x)

## [5.1.1.3](https://git.d3data.de/D3Private/Usermanager/compare/5.1.1.2...5.1.1.3) - 2023-05-03
### Fixed
- missing from part in emails in case of unconfigured reply address

## [5.1.1.2](https://git.d3data.de/D3Private/Usermanager/compare/5.1.1.1...5.1.1.2) - 2023-04-17
### Fixed
- non runing cron script

## [5.1.1.1](https://git.d3data.de/D3Private/Usermanager/compare/5.1.1.0...5.1.1.1) - 2023-03-16
### Fixed
- compatibility problem under PHP - ^8 in combination with D3 Ordermanager

## [5.1.1.0](https://git.d3data.de/D3Private/Usermanager/compare/5.0.1.0...5.1.1.0) - 2022-12-20
### Added
- installierbar in OXID 6.4 und 6.5 sowie PHP 8.1
- Platzhalter in Push Notification URLs werden nun für dynamische Parameter geparst
- zusätzliche GET Parameter werden bei POST Verwendung an den POST Body angehängt

### Changed
- adjust DI container to updated container dependency
- adjust tests
- extract message content creator from mail class
- make mySQL content check more compatible
- adjust documentation to Source Guardian Loader based installation
- changelog improved
- Dateiregister für kommende Connector-Version angepasst
- CLI-Prüfung für PHP interne Server angepasst

### Fixed
- prevent "undefined array key" warning
- timespan requirement option in admin panel does not represent the saved type
- Type cast Fehler korrigiert

## 5.0.1.0 - (2021-10-01)

### Added
- installierbar in OXID 6.3.x

### Changed
- #10850: Limitierung wird vorzeitig auf das Ergebnis des Filterqueries angewandt
- Tests angepasst

### Fixed
- #10933: Übersicht zeigt falsche Anzahlen
- Eingabekonvertierung bei Rabatt ändern Aktion optimiert
- Übersicht zeigt richtige Templatequelle der Exportaktion an

---

## 4.1.2.3 - (2021-05-10)

### Fixed
- fehlender OXID-Service im no-dev-Modus führt zu Fehlern im Modul

--- 

## 4.1.2.2 - (2021-05-07)

### Added
- installierbar in OXID 6.2.4

### Changed
- D3 Methoden in öffentlichen Klassen mit individuellen Namen versehen

### Fixed
- Syntaxfehler in Wochentagsbedingungsprüfung korrigiert
- erweiterte Methoden für Kompatibilität mit Elternmethoden angepasst
- Warnung bei Verwendung der Standardsprache bei CLI-Aufrufen entfernt
- Fehler bei undefinierter STDOUT Konstante behoben
- Verwendung leerer Tasklisten optimiert
- Einstellungszuordnungen optimiert

---

## 4.1.2.0 - (2021-03-10)

** Hinweis für kleinere Versions-Upgrades: Es gibt einige rückwärts-inkompatible Änderungen an dieser Version. **

### Added
- erweiterte Konfigurationsprüfung integriert
- Ausführungsabbruch mit passenden Fehlermeldungen bei Konfigurationsfehlern eingefügt
- Debugausgaben werden auch bei Konsolenausführung gezeigt
- statische Auswahllisten sind erweiterbar
- Prüfung und Behandlung von Kompilierungsfehlern aufgrund fehlerhafter Smarty-Codes
- Abfangen leerer Inhalte auf Grund von falsch encodeten Templatedateien
- Profiling für CLI und GUI integriert
- Historyeinträge können optional angelegt werden
- globale Filter pro Shopmandant für Migrationsfälle konfigurierbar

### Changed
- Bedingungen- und Aktioneninterfaces aktualisiert
- Response-Script für automatische Ausführung als abgekündigt markiert
- Exportdateinamen wird für gültige Dateinamen überarbeitet
- Modul verwendet strict types
- Remark anlegen optimiert

### Fixed
- Bedingung "gesetzte Rechnungsnummer" korrigiert
- Endlosschleifen bei Ausführung von finalizeOrder- und orderSave-Trigger verhindert
- Ordnernamen, die nicht aus Übersetzungen kommen, zeigen keine Fehlermeldung
- nicht generierbare Statusmails korrigiert
- Debugmodus verwendet SQL-Logger für optimierte Anzeige
- nicht geladenes Manager-Objekt im Admincontroller korrigiert
- "Einträge als erledigt markieren" ignoriert "Einträge nicht als erledigt markieren"-Option 

---

## 4.1.1.0 - (2020-12-21) - (aus Kompatibilitätsgründen zu Auftragsmanager-Release)

** Hinweis für kleinere Versions-Upgrades: Es gibt einige rückwärts-inkompatible Änderungen an dieser Version. **

### Added
- Angepasst für Shopversion 6.2.3
- Zufallspasswort wird im Installationsprozess erstellt
- CLI-Aufrufe ermöglicht
- Push Notification Aktion hinzugefügt
- Bedingungen verwenden QueryBuilder statt plain SQL
- Verwendung des Injection Containers integriert
- automatisierte Tests eingefügt

### Changed
- unnötige Parameterprüfung für Plain-Inhalte der Mails entfernt
- an Code des Autragsmanager Moduls angepasst

### Fixed
- Queryfehler korrigiert

---

## 3.3.0.0 - (2020-10-02) - (aus Kompatibilitätsgründen zu Ordermanager-Release)

** Hinweis für kleinere Versions-Upgrades: Es gibt einige rückwärts-inkompatible Änderungen an dieser Version. **

#### Added
- Angepasst für Shopversion 6.x, Installation via Composer 

---

## 2.3.2.0
- beim Speichern der Aktionen wird auf unzureichend ausgefüllte Werte hingewiesen
- beim Speichern der Bedingungen wird auf unzureichend ausgefüllte Werte hingewiesen
- fehlerhafte Abfragen für "nicht in Kundengruppe", "Registrierzeitraum" und "Bestellzeitraum" korrigiert 
- Einstellungen intuitiver benannt
- ermöglicht nichtnumerische Cronjob-IDs
- Abfrage für not-in-Zuordnungen korrigiert
- falsche Modul-ID korrigiert

---

## 2.3.1.0
- gewählte Einträge als "bearbeitet" markieren
- neue Bedingung "wenn Kundenkonto (nicht) durch Aufgabe X bearbeitet wurde" (#4794)
- Exportdateinamen optimiert
- Optik des Adminbereichs optimiert
- Adminseitentitel angepasst
- Apache 2.4-Kompatibilität eingefügt
- Querycheck ergänzt
- Angleichung an Auftragsmanager für vereinfachten Featuretransfer
- Datenbankabfragen korrigiert

---

## 2.3.0.0
- OXID 4.9 / 5.2 Installationsanweisungen eingefügt
- Cronjob-ID für gezieltere Aufgabenaufrufe integriert
- Remark- und Info-Handling optimiert
- alternative From- und Reply-Adresse in Mailsendeaktion integriert
- Templatequelle für Mailsendeaktion kann nun auch ein Modulverzeichnis sein
- Templatestruktur bereinigt
- SH-Generator integriert
- Cronjob-ID für Shellaufrufe nachgetragen
- Optimierung für Multilang-Tabellen integriert
- zu bearbeitendes Kundenkonto wird separat (außerhalb der userlist) geladen, sind sonst unvollständig
- einzelne Modprofile-Felder von Multilang-Speicherung ausgeschlossen, da Aufgaben nicht sprachabhängig ausgeführt werden können
- Performance: Statistikabfragen optimiert
- Performance: Statistikauswertungen können einzeln abgefragt werden
- Zeit-Bedingungen für stehengelassene Warenkörbe eingefügt
- Zeit-Bedingung für bestellte Warenkörbe eingefügt

---

## 2.2.0.0
- zusätzliche Bedingungen integriert
  - nach gespeicherten Warenkörben (ja / nein)
  - nach gespeicherten Merkzetteln (ja / nein / Anzahl)
  - nach gespeicherten Wunschzetteln (ja / nein / Anzahl)
  - nach verwendeten Gutscheinen (ja / nein / Gutscheinnummer / Gutscheinserie)
  - Alter (< / > / =)
  - Freifeldprüfung an Bestellungen
- Hilfetexte vervollständigt
- Modul schreibt umfangreicheres Logging über Ausführung
- Aktivstatus für "manuell" und "Ausführung per Cronjob" eindeutiger definiert
- Aufgabenbeschreibung als Langtext
- Beschreibung der Beispielaufgaben vervollständigt
- zusätzliche Beispielaufgabe eingefügt

---

## 2.1.1.0
- Bedingungen: Filterung nach Umsatzzahlen aus allen Bestellungen des Kunden
- Korrektur: Aufgabe "Warenkorbabbrecher reaktivieren" verursacht einen Fatal Error

---

## 2.1.0.1
- "Auftrag manuell ausführbar"-Option korrigiert
- Cronjob-Fehler werden zusätzlich im Cronjob ausgegeben

---

## 2.1.0.0 (aus Kompatibilitätsgründen zu Ordermanager-Release)
- grundsätzliche Filter- und Ausführungsoptionen eingefügt
- neues Lizenzschema integriert
