#### 2.0.0

Danke an Kirk und 69bruno die uns beim testen geholfen haben. :-)

Hinweis: Diese Version ist nicht kompatibel mit 1.0.0. Bevor 2.0.0 installiert werden kann, muss 1.0.0 deinstalliert werden. Dazu im ACP in der Ansicht "ANPASSEN" die Kurzanleitung "EINE ERWEITERUNG KOMPLETT AUS DEM BOARD ENTFERNEN" am Ende der Seite berücksichtigen.

* Fix: Nach der Reaktivierung funktionierten manche Erweiterungen nicht korrekt, was primär auf deren Template Darstellungen bezogen ist. Die Ursache für das Problem war der Twig Cache, der nicht mehr vollständig aufgebaut wurde. Ein Workaround sorgt nun dafür, dass der gesamte Cache nach Aktivierung/Deaktivierung wieder vollständig aufgebaut wird.
* Fix: Mehrere kleinere Fehler behoben. Unter anderem fehlte im ACP Modul das Security Token, dass in jedem Formular vorhanden sein muss.
* Wenn eine Erweiterung aufgrund fehlender Voraussetzungen nicht aktiviert werden kann und eine eigene Fehlerbehandlung hat (`trigger_error`), dann unterbricht diese Erweiterung den kompletten Aktivierungsvorgang. Dafür eine zusätzliche Anzeige eingebaut die dann in der Standard Fehlermeldung von phpBB präzise Auskunft darüber gibt, welche Erweiterung den Vorgang unterbrochen hat.
* Wenn die Aktion "Alle aktivieren" durch eine Erweiterung hart unterbrochen wird, dann kann jetzt trotzdem ein Log Eintrag erzeugt werden, der den partiellen Erfolg protokolliert.
* Deaktivierte Erweiterungen werden nun auf neue Migrationsdateien geprüft. Sind solche vorhanden, werden die betreffenden Erweiterungen bei der Aktivierung per Standard ignoriert.
* In der Bestätigungsmeldung die phpBB nach Aktivierung/Deaktivierung angezeigt, wird die Anzahl der erfolgreich geschalteten Erweiterungen und die Gesamtzahl angezeigt. Dadurch ist sofort erkennbar, ob bei einer Aktion eine Erweiterung nicht geschaltet werden konnte.
* Im Log wird nun ebenfalls die Anzahl der erfolgreich geschalteten Erweiterungen und die Gesamtzahl protokolliert.
* Es gibt bei Aktivierung/Deaktivierung per Standard eine Rückfrage die bestätigt werden muss, wie das phpBB bei der manuellen Aktivierung/Deaktivierung auch selbst macht.
* Die Protokollierung im Administrator-Log bei Aktivierung/Deaktivierung ist nun abschaltbar.
* Integration in "Erweiterungen Verwalten":
  * Die Buttons werden gesperrt, wenn eine Aktion nicht möglich ist. Dadurch entfiel die bisherige Fehlermeldung und deren Bestätigung, wenn eine Aktion nicht möglich war.
  * In der Überschrift "Aktivierte Erweiterungen" wird die Anzahl der aktivierten Erweiterungen angezeigt.
  * In der Überschrift "Deaktivierte Erweiterungen" wird die Anzahl der Erweiterungen angezeigt, aufgeteilt nach "installiert", "neue Migrationen" und "nicht installiert".
  * Deaktivierte Erweiterungen bei denen neue Migrationsdateien vorhanden sind, werden mit einem Aufwärts-Pfeil markiert und zusätzlich wird die Anzahl neuer Migrationsdateien in Klammern angezeigt.
* ACP Modul (Einstellungen):
  * Die Buttons werden gesperrt, wenn eine Aktion nicht möglich ist. Dadurch entfiel die bisherige Fehlermeldung und deren Bestätigung, wenn eine Aktion nicht möglich war.
  * In der Button-Beschriftung wird jeweils die Anzahl der zu schaltenden Erweiterungen angezeigt.
  * Die Info-Zeile entfernt, die Auskunft über die Anzahl der deaktivierbaren Erweiterungen gab, da diese nun keine Relevanz mehr hat.
  * Neue Option zum deaktivieren der Log Funktion.
  * Neue Option zum deaktivieren der Rückfrage.
  * Neue Experten-Option für die Aktion "Alle aktivieren" bezüglich Handhabung von Erweiterungen die neue Migrationsdateien enthalten.
  * Die Standardwerte der Einstellungen werden angezeigt.
* Das Sprachpaket-Infosystem von LFWWH übernommen:
  * Übersetzer können ihre Autoren-Infos direkt in 3 Sprachvariablen in `acp_extonoff.php` definieren.
  * Diese Autoren-Infos werden im ACP Modul im Footer angezeigt.
  * Das System bietet eine Versionsprüfung des Sprachpakets: Ist eine Übersetzung veraltet, bekommt der Administrator einen entsprechenden Hinweis im ACP Modul.
* Zahlreiche Änderungen in den Sprachdateien sowie etliche neue Sprachvariablen.

#### 1.0.0

* Erste öffentliche Version
