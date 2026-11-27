# Changelog

## Unveröffentlicht

- Besucher probieren die **Seiteneinstellungen** aus: Adresse (auch eigene Adresse und Ebene ausblenden), SEO-Angaben
  und **Kurzlinks** – gemerkt und abgespielt wie die Blöcke, gespeichert wird nichts. Titel und Online-Status bleiben
  unverändert. Voraussetzung: Die Rolle des Demo-Benutzers hat „Artikel bearbeiten“ bzw. „Kategorien bearbeiten“.
- Das Routing läuft in der Demo ohne Cache-Dateien (`Routes::volatile()` aus fluid) – geänderte Adressen erreichen
  nie andere Besucher.
- Nach dem Abspielen bleiben API- und Ansichtsadressen des Editors auf der echten Adresse der Seite.
- Bilder: Regeln aus InlineStyle beim Abspielen übernehmen (eee4379); `{fluid-version}` auf der Website (0e4aa47).

## 1.0.0-beta.1 – 2026-11-18

- Demo für fluid als eigenes AddOn:
  - Besucher starten die Demo per Knopf nach einer Bot-Prüfung ohne Dienste Dritter (Rechenaufgabe, unsichtbares
    Feld, Mindestzeit, Begrenzung je IP).
  - Sie bearbeiten die Website wie echt, gespeichert wird nichts: Jede Anfrage läuft in einer Transaktion, die
    zurückgerollt wird.
  - Gäste sehen nur Öffentliches: Live-Fassung, ohne Offline-Blöcke, ohne interne Einstellungen.
  - Hervorgegangen aus einem Entwurf, der zunächst direkt in fluid steckte.
- Kit ausprobieren: Knopf „Kit: …“ in der Leiste (ab zwei Kits) wechselt das Kit nur im eigenen Browser (Cookie
  `fluid_demo_kit`, ausgewertet über `FLUID_KIT` nur in einer gestarteten Demo); Design-Vorschau je Kit.
- Angepasst an REDAXO-Core `cf598c1`: kein `uninstall()` mehr. Entfernen per `composer remove` und
  `console migrate:cleanup`, die Demo vorher ausschalten (README).
