<?php

function wpse27856_set_content_type()
{
    return "text/html";
}

function albumsRename($a)
{
    if (1 == $a):
        return "płyta";
    elseif ($a > 1 && $a < 5):
        return "płyty";
    else:
        return "płyt";
    endif;
}

function sendmail_contact()
{
    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $messageClients = $_POST['message'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }
        if (empty($messageClients)) {
            echo __('Nie podano treści wiadomości <br>');
        }
        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($checkbox) && !empty($messageClients)):
            $to = get_field('kontakt_', 'option');
            $sub = 'Wiadomość - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><br><b>Treść wiadomości:</b><br><em>" . $messageClients . "</em> <br></p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";
            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas wiadomości. Niebawem skontaktujemy się z Tobą. <br> <br><b>Treść wiadomości:</b><br><em>" . $messageClients . "</em> <br></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";
            if (wp_mail($to, $sub, $message)):
                wp_mail($mail, 'Agencja Brussa', $messageClient);
                echo __('Wiadomość wysłana');
            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();
}

function sendmail_info()
{
    $message = $_POST['message'];
    if (!empty($message)):
        $to = get_field('informacja_o_stronie', 'option');
        if (wp_mail($to, "Informacja o stronie", $message)):
            echo __('Wiadomość wysłana. Dziękujemy');
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Nie podano treści wiadomości');
    endif;
    die();
}

function ordered_discs()
{

    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $albumName = $_POST['albumName'];
        $amount = $_POST['amount'];
        $cost = $_POST['cost'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }
        if (empty($address)) {
            echo __('Nie podano adresu do wysyłki <br>');
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($checkbox) && !empty($address)):
            $sub = 'Zamówienie płyty - ' . $name;
            $to = get_field('zamowienia_plyt', 'option');

            $message = "<html><body><h1>Witaj!</h1><p><b>Zamówienie od:</b> <br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><em>Adres: " . $address . "</em><br><br><b>Zamówienie:</b><br><em>" . $amount . " " . albumsRename($amount) . " - " . $albumName . " <br><br> <b>Wartość zamówienia:</b> <br> " . $cost . " PLN (w tym doliczony koszt przesyłki)</em> <br></p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za złożenie zamówienia. <br><br>Twoje zamówienie wyślemy kurierem na adres:<br><em>" . $address . "</em><br><br>Zamówienie obejmuje:<br><em>" . $amount . " " . albumsRename($amount) . " - " . $albumName . " <br> Wartość zamówienia: <br>" . $cost . " PLN (w tym doliczony koszt przesyłki)</em><br><br>Jeśli zamówisz kilka płyt w ciągu jednego dnia, wszystkie płyty wyślemy jedną paczką w dniu nastepnym. Opłata za wysyłkę zostanie naliczona tylko raz.<br><br>W razie pytań prosimy o kontakt pod adresem e-mail:<br><em>" . $to . "</em> <br></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                wp_mail($mail, 'Agencja Brussa', $messageClient);
                echo __('Zamówienie wysłane');
            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}
function ordered_discs_two()
{

    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $albumName = $_POST['albumName'];
        $amount = $_POST['amount'];
        $delivery = $_POST['delivery'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }
        if (empty($address)) {
            echo __('Nie podano adresu do wysyłki <br>');
        }
        if (empty($delivery)) {
            echo __('Nie wybrano formy dostawy <br>');
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($checkbox) && !empty($delivery) && !empty($address)):
            $sub = 'Zamówienie płyty - ' . $name;
            $to = get_field('zamowienia_plyt', 'option');

            $message = "<html><body><h1>Witaj!</h1><p><b>Zamówienie od:</b> <br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><em>Adres: " . $address . "</em><br><br><b>Zamówienie:</b><br><em>" . $amount . " " . albumsRename($amount) . " - " . $albumName . " <br><br> <b>Forma dostawy:</b> <br> " . $delivery . " PLN (w tym doliczony koszt przesyłki)</em> <br></p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za złożenie zamówienia. <br><br>Twoje zamówienie wyślemy kurierem na adres:<br><em>" . $address . "</em><br><br>Zamówienie obejmuje:<br><em>" . $amount . " " . albumsRename($amount) . " - " . $albumName . " <br></em><br><br>W razie pytań prosimy o kontakt pod adresem e-mail:<br><em>" . $to . "</em> <br></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                wp_mail($mail, 'Agencja Brussa', $messageClient);
                echo __('Zamówienie wysłane');
            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}

function order_our()
{

    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        $now = date('Y-m-d');
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $artist = $_POST['artist'];
        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $date = $_POST['date'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }
        if (empty($city)) {
            echo __('Nie podano miasta <br>');
        }
        if ($date < $now) {
            echo __('Nieprawidłowa data <br>');
            exit;
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($checkbox) && !empty($city) && !empty($date)):

            $to = get_field('nasze_produkcje_-_zamow_termin', 'option');
            $sub = 'Zamówienie projektu - ' . $artist . ' - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><br>Prośba o rezerwacje terminu artysty:<br><em><b>" . $artist . "</b> w mieście, <b>" . $city . "</b> dnia <b>" . $date . "</b></em><br><br> Skontaktuj się z klientem w celu potwierdzenia terminu oraz ustalenia szczegółów.</p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas wiadomości. Niebawem skontaktujemy się z Tobą. <br> <br><b>Treść wiadomości:</b><br><em>Prośba o rezerwacje terminu artysty:<br><em><b>" . $artist . "</b> w mieście, <b>" . $city . "</b> dnia <b>" . $date . "</b></em></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                echo __('Zamówienie wysłane');
                wp_mail($mail, 'Agencja Brussa', $messageClient);

            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}
function order_artist()
{

    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        $now = date('Y-m-d');
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $artist = $_POST['artist'];
        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $date = $_POST['date'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }
        if (empty($city)) {
            echo __('Nie podano miasta <br>');
        }
        if ($date < $now) {
            echo __('Nieprawidłowa data <br>');
            exit;
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($checkbox) && !empty($city) && !empty($date)):

            $to = get_field('oferta_-_zamow_artyste', 'option');
            $sub = 'Zamówienie artysty - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><br>Prośba o rezerwacje terminu artysty:<br><em><b>" . $artist . "</b> w mieście, <b>" . $city . "</b> dnia <b>" . $date . "</b></em><br><br> Skontaktuj się z klientem w celu potwierdzenia terminu oraz ustalenia szczegółów.</p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas wiadomości. Niebawem skontaktujemy się z Tobą. <br> <br><b>Treść wiadomości:</b><br><em>Prośba o rezerwacje terminu artysty:<br><em><b>" . $artist . "</b> w mieście, <b>" . $city . "</b> dnia <b>" . $date . "</b></em></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                echo __('Zamówienie wysłane');
                wp_mail($mail, 'Agencja Brussa', $messageClient);

            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}

function date_artist()
{

    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $artist = $_POST['artist'];
        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($checkbox)):

            $to = get_field('oferta_-_wolny_termin', 'option');
            $sub = 'Wolne terminy - ' . $artist . ' - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><br>Pytanie o wolne terminy artysty:<br><em><b>" . $artist . "</b></em><br><br> Skontaktuj się z klientem w celu ustalenia szczegółów.</p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas wiadomości. Niebawem skontaktujemy się z Tobą. <br> <br><b>Treść wiadomości:</b><br><em>Pytanie o wolne terminy występów:<br><em><b>" . $artist . "</b></em></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                echo __('Prośba wysłana');
                wp_mail($mail, 'Agencja Brussa', $messageClient);

            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}

function contact_artist()
{

    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $artist = $_POST['artist'];
        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($checkbox)):

            $to = get_field('oferta_-_prosba_o_kontakt', 'option');
            $sub = 'Kontakt w sprawie - ' . $artist . ' - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><br>Kontakt w sprawie artysty:<br><em><b>" . $artist . "</b></em><br><br> Skontaktuj się z klientem.</p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas wiadomości. Niebawem skontaktujemy się z Tobą. <br> <br><b>Treść wiadomości:</b><br><em>Kontakt w sprawie artysty: <br><em><b>" . $artist . "</b></em></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                echo __('Prośba wysłana');
                wp_mail($mail, 'Agencja Brussa', $messageClient);

            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}
function contact_our()
{

    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $artist = $_POST['artist'];
        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($checkbox)):

            $to = get_field('nasze_produkcje_-_mam_pytanie', 'option');
            $sub = 'Kontakt w sprawie - ' . $artist . ' - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><br>Kontakt w sprawie artysty:<br><em><b>" . $artist . "</b></em><br><br> Skontaktuj się z klientem.</p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas wiadomości. Niebawem skontaktujemy się z Tobą. <br> <br><b>Treść wiadomości:</b><br><em>Kontakt w sprawie artysty: <br><em><b>" . $artist . "</b></em></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                echo __('Prośba wysłana');
                wp_mail($mail, 'Agencja Brussa', $messageClient);

            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}

function work()
{
    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $position = $_POST['position'];
        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $experience = $_POST['experience'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }
        if (empty($age)) {
            echo __('Nie podano wieku <br>');
        }
        if (empty($experience)) {
            echo __('Nie opisano doświadczenia <br>');
        }
        if (empty($address)) {
            echo __('Nie opisano adresu zamieszkania<br>');
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($age) && !empty($experience) && !empty($checkbox)):

            $to = get_field('praca', 'option');
            $sub = 'Praca - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em><br><em>Adres zamieszkania: " . $address . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><em>Wiek: " . $age . " lat</em><br><br>Doświadczene:<br><em><b>" . $experience . "</b></em></p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas zgłoszenia.</em></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                echo __('Zgłoszenie wysłane');
                wp_mail($mail, 'Agencja Brussa - Praca', $messageClient);

            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}
function contact_stage()
{
    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $offerStage = $_POST['offerStage'];
        $date = $_POST['date'];
        $city = $_POST['city'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }
        if (empty($offerStage)) {
            echo __('Nie podano wieku <br>');
        }
        if (empty($date)) {
            echo __('Nie opisano doświadczenia <br>');
        }
        if (empty($city)) {
            echo __('Nie opisano adresu zamieszkania<br>');
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($offerStage) && !empty($date) && !empty($city)):

            $to = get_field('obsluga_wydarzen', 'option');
            $sub = 'Obsługa wydarzenia - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em><br><em>Miasto: " . $city . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><em>Usługa: " . $offerStage . " lat</em><br><br>Data:<br><em><b>" . $date . "</b></em></p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas zgłoszenia.</em></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                echo __('Zgłoszenie wysłane');
                wp_mail($mail, 'Agencja Brussa - Obsługa wydarzenia', $messageClient);

            else:
                echo __('1 Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('2 Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}

function cooperation()
{
    $checkbox = $_POST['checkbox'];
    if ('1' == $checkbox):
        add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

        $name = $_POST['name'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        $messageClients = $_POST['message'];

        if (empty($name)) {
            echo __('Nie podano danych osobowych <br>');
        }
        if (empty($mail)) {
            echo __('Nie podanu adresu e-mail <br>');
        }
        if (empty($phone)) {
            echo __('Nie podano numeru telefonu <br>');
        }
        if (empty($messageClients)) {
            echo __('Nie napisano wiadomości <br>');
        }

        if (!empty($name) && !empty($mail) && !empty($phone) && !empty($messageClients) && !empty($checkbox)):

            $to = get_field('wspolpraca', 'option');
            $sub = 'Współpraca - ' . $name;

            $message = "<html><body><h1>Witaj!</h1><p>Wiadomość od: <br><br><em>" . $name . "</em> <br><em>Telefon: " . $phone . "</em><br><em>E-mail: " . $mail . "</em><br><br><b>Treść wiadomości:</b><br><em>" . $messageClients . "</em> <br></p> <br><br><p>--- Wiadomość wysłana ze strony internetowej ---</p></body></html>";

            $messageClient = "<html><body><h1>Witaj!</h1><p>Dziękujemy za wysłanie do nas wiadomości. Niebawem skontaktujemy się z Tobą. <br> <br><b>Treść wiadomości:</b><br><em>" . $messageClients . "</em> <br></p> <br><br><p>--- Wiadomość automatyczna - prosimy nie odpowiadać ---</p></body></html>";

            if (wp_mail($to, $sub, $message)):
                echo __('Zgłoszenie wysłane');
                wp_mail($mail, 'Agencja Brussa - Praca', $messageClient);

            else:
                echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
            endif;
        else:
            echo __('Problem z wysłaniem wiadomości. Spróbuj na: ') . $to;
        endif;
    else:
        echo __('Wymagana zgoda');
    endif;
    remove_filter('wp_mail_content_type', 'wpse27856_set_content_type');
    die();

}