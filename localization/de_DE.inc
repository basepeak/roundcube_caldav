<?php

/**
 * +-----------------------------------------------------------------------+
 * | Deutsche Übsetzung des Roundcube Webmail Enigma Plugins               |
 * |                                                                       |
 * | Copyright (C) Host-On Service Provider GmbH                           |
 * |                                                                       |
 * | Lizenziert unter der GNU General Public License Version 3 oder        |
 * | jeder späteren Version mit Ausnahmen für Skins & Plugins.             |
 * | Siehe die README-Datei für die vollständige Lizenzbeschreibung.       |
 * +-----------------------------------------------------------------------+
 */

$labels = array();
$labels['server_caldav'] = 'Konfiguration des CalDAV-Servers';
$labels['url_base'] = "Bitte geben Sie die URL Ihres CalDAV-Servers im Format an: \n https://demo.souvera.work/remote.php/calendars/ihrbenutzername";
$labels['login'] = 'Bitte geben Sie Ihren Server-Benutzernamen an';
$labels['password'] = 'Bitte geben Sie Ihr Passwort an';
$labels['save_error_msg'] = 'Ihre Angaben sind falsch oder unvollständig';
$labels['main_calendar'] = 'Legen Sie Ihren Standardkalender fest';
$labels['calendar_choice'] = "Achtung: Wenn Sie URL / Login / Passwort ändern, werden Ihre Einstellungen zurückgesetzt.\n Wählen Sie Ihren Standardkalender (Radiobutton) und weitere Kalender, die Sie nutzen möchten (Checkboxen).";
$labels['connect_error_msg'] = 'Verbindung zum CalDAV-Server fehlgeschlagen';
$labels['find_calendar_error'] = 'Beim Abrufen der Kalender ist ein Fehler aufgetreten';
$labels['something_happened_while_sending_information_to_client'] = "Fehler beim Senden von Informationen an den Client";
$labels['ErrorEmptyArrayOfCalendar'] = "Es ist kein Kalender ausgewählt";
$labels['invitation'] = 'Sie haben eine Einladung erhalten';
$labels['same_hour_meeting'] = 'In diesem Zeitraum haben Sie bereits ein oder mehrere Termine: ';
$labels['attendee'] = 'Teilnehmer: ';
$labels['reply_all'] = 'Allen antworten';
$labels['previous_meeting'] = 'Vorheriger Termin: ';
$labels['next_meeting'] = 'Nächster Termin: ';
$labels['all_day'] = 'Ganztägig';
$labels['successfully_saved'] = 'Dieser Termin wurde in Ihrem Kalender gespeichert';
$labels['successfully_sent'] = "Die E-Mail mit Ihren Änderungen wurde verschickt";
$labels['something_happened'] = "Ein Fehler ist aufgetreten, der Termin wurde nicht in Ihrem Kalender hinzugefügt";
$labels['something_happened_when_sending'] = "Ein Fehler ist aufgetreten, die E-Mail wurde nicht versendet";
$labels['no_participant_to_answer'] = "Es wurde keine E-Mail verschickt, da die Teilnehmer keine Antwort erhalten möchten";
$labels['confirm'] = 'Bestätigen';
$labels['tentative'] = 'Vorläufig';
$labels['decline'] = "Ablehnen";
$labels['confirmed'] = 'Bestätigt';
$labels['tentatived'] = 'Vorläufig bestätigt';
$labels['declined'] = "Abgelehnt";
$labels['confirmed_organizer'] = 'Vorschlag bestätigt';
$labels['declined_organizer'] = "Vorschlag abgelehnt";
$labels['location'] = "Ort: ";
$labels['description'] = "Beschreibung: ";
$labels['choose_calendar_to_add'] = "Diesen Termin hinzufügen zu:";
$labels['event_not_found_which_calendar_to_add'] = "Termin in Ihren Kalendern nicht gefunden, auch wenn Sie Organisator sind. \n
In welchen Kalender soll der Termin eingetragen werden?";
$labels['repeated_event'] = "Dieser Termin wiederholt sich mehrfach";
$labels['use_this_calendar'] = "Diesen Kalender verwenden ";
$labels['make_this_calendar_default1'] = "Den ";
$labels['make_this_calendar_default2'] = " Kalender als Standard festlegen";
$labels['reschedule_meeting'] = "Diesen Termin neu planen";
$labels['ask_for_reschedule'] = "Um eine Terminverschiebung bitten";
$labels['ask_rescheduled_msg'] = 'Sie haben eine Verschiebung dieses Termins angefordert:';
$labels['cancel'] = "Abbrechen";
$labels['new_date_start'] = 'Neues Startdatum für diesen Termin';
$labels['new_time_start'] = 'Neue Startzeit';
$labels['new_time_end'] = 'Neue Endzeit';
$labels['new_date_end'] = 'Neues Enddatum für diesen Termin';
$labels['new_location'] = 'Neuen Ort wählen';
$labels['if_rescheduled_msg'] = 'Sie haben diesen Termin verschoben:';
$labels['error_date_inf'] = 'Achtung! Das Startdatum darf nicht nach dem Enddatum liegen';
$labels['error_incomplete_field'] = "Achtung! Sie haben nicht alle erforderlichen Felder ausgefüllt (entweder den Ort oder alle Datumsfelder)";
$labels['modified_event'] = "<b>Achtung</b> Der angezeigte Termin entspricht nicht der empfangenen Einladung, es handelt sich um eine neuere Version aus dem Kalender ";
$labels['missing_summary'] = "Ohne Titel";
$labels['CONFIRMED'] = '[BESTÄTIGT]: ';
$labels['TENTATIVE'] = '[VORLÄUFIG]: ';
$labels['CANCELLED'] = "[ABGELEHNT]: ";
$labels['MODIFIED'] = '[GEÄNDERT]: ';
$labels['CANCEL'] = '[STORNIERT]: ';
$labels['DECLINECOUNTER'] = '[ÄNDERUNG ABGELEHNT]: ';
$labels['all_day'] = 'Ganztägig';
$labels['loading'] = 'Lade...';
$labels['something_happened_while_getting_events'] = "Beim Abrufen der Termine vom CalDAV-Server ist ein Fehler aufgetreten";
$labels['invitation_modification'] = "Sie haben eine Änderung zu Ihrer Einladung erhalten";
$labels['invitation_modification_already_studied'] = "Die vorgeschlagenen Änderungen für diesen Termin wurden bereits geprüft";
$labels['confirm_modification'] = "Änderungen bestätigen";
$labels['decline_modification'] = "Änderungen ablehnen";
$labels['cancel_event'] = "Termin absagen";
$labels['cancel_instance'] = "Diesen einzelnen Termin absagen";
$labels['cancelled_instance'] = "Einzeltermin abgesagt";
$labels['update_event'] = "Termin auf Server aktualisieren";
$labels['updated_event'] = "Termin wurde aktualisiert";
$labels['cancel_event_on_server'] = "Termin auf Server absagen";
$labels['cancelled_event_on_server'] = "Termin wurde auf dem Server abgesagt";
$labels['cancelled_event'] = "Termin wurde abgesagt";
$labels['invitation_accepted'] = " hat Ihre Einladung zum Termin angenommen:  ";
$labels['invitation_tentative'] = " ist interessiert an Ihrer Einladung zum Termin: ";
$labels['invitation_declined'] = " hat Ihre Einladung zum Termin abgelehnt:";
$labels['unknown_reply'] = " hat auf Ihre Einladung geantwortet, ohne in der Teilnehmerliste zu stehen";
$labels['new_location_proposal'] = "Neuer Ortsvorschlag: ";
$labels['new_description_proposal'] = "Neuer Beschreibungsvorschlag: ";
$labels['new_location_modification'] = "Ort geändert: ";
$labels['new_description_modification'] = "Beschreibung geändert: ";
$labels['if_modification'] = "Änderungen werden grün dargestellt";
$labels['if_no_modification'] = "Änderungen wurden bereits übernommen";
$labels['invitation_send'] = "Sie haben eine Einladung verschickt für: ";
$labels['invitation_decline_modifications1'] = "Sie haben die vorgeschlagenen Änderungen von ";
$labels['invitation_decline_modifications2'] = " abgelehnt";
$labels['invitation_declined_by_organizer'] = "Ihr Änderungsvorschlag wurde vom Organisator nicht akzeptiert";
$labels['invitation_cancel'] = "Dieser Termin wurde vom Organisator gelöscht";
$labels['invitation_cancel_for_organizer'] = "Sie haben diesen Termin gelöscht";
$labels['present_but_older'] = 'Sie haben diesen Termin bereits auf Ihrem Server, jedoch in einer älteren Version';
$labels['send_comment_with_invitation'] = "Einen Kommentar mit Ihrer Antwort per E-Mail senden";
$labels['comment_to_send'] = "Zu sendender Kommentar";
$labels['send_without_comment'] = "Ohne Kommentar senden";
$labels['comment'] = "Kommentar des Absenders: ";
$labels['saving_and_sending'] = "Änderungen speichern und E-Mails versenden";
$labels['main_calendar_error'] = "Sie müssen einen Standardkalender auswählen";
$labels['no_title'] = "Ein Termin ohne Titel";
$labels['main_calendar_not_exist'] = "Der von Ihnen als Standard gewählte Kalender existiert nicht oder nicht mehr auf Ihrem Server.";
$labels['no_calendar_found'] = "Es ist kein Kalender auf Ihrem Server verfügbar";

?>
