---
title: Changelog
---

## 3.3.0.1 - (2021-03-10)

### Added
- erweiterte Konfigurationsprüfung integriert
- CLI-Klasse für Konsolenaufrufe eigefügt

### Changed
- im Installationsprozess wird Zufallspasswort gesetzt
- unnötige Prüfung für Plain-Template in Mail-Aktion entfernt (Plain kann aus HTML generiert werden)

### Fixed
- "Einträge als erledigt markieren" ignoriert "Einträge nich als erledigt markieren"-Option

---

## 3.3.0.0 - (2020-10-02) - (aus Kompatibilitätsgründen zu Ordermanager-Release)

**Minor version upgrade notice: there are some backward-incompatible changes to this release.**

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
