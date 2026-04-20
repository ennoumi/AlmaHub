<?php

class DatabaseHelper {
    private $db; 

    public function __construct(string $host, string $user, string $pass, string $name, int $port = 3306){
        $this->db = new mysqli($host, $user, $pass, $name, $port);

        if($this->db->connect_error){
            die("Errore connessione DB: " . $this->db->connect_error);
        }
    }

    public function close(): void{
        $this->db->close();
    }

    /*Funzione per richiamare tutti i gruppi esistenti nel DB
    da stampare nella dashboard dell'utente per la scelta dell'iscrizione 
    */

    public function getAllGroups() :array{
    $stmt = $this->db->prepare("SELECT id_gruppo, tipo, titolo, corso FROM gruppi");

    $stmt->execute();
    $res = $stmt->get_result();
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    /*Funzione per richiamare dal DB i gruppi a cui l'utente loggato è iscritto */

    public function getPersonalGroups(int $userId) :array {
        $stmt = $this->db->prepare("SELECT G.id_gruppo, tipo, titolo, corso FROM gruppi G 
                                    JOIN iscrizioni I ON G.id_gruppo = I.id_gruppo 
                                    JOIN utenti U ON U.id_utente=I.id_utente
                                    WHERE U.id_utente = ?");
        if (!$stmt) return [];

        $stmt->bind_param("i", $userId);

        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getAvailableGroups(int $idUtente) :array {
        $query = "SELECT * FROM gruppi 
                    WHERE id_gruppo NOT IN 
                    (SELECT id_gruppo FROM iscrizioni WHERE id_utente = ?)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Funzione che restituisce tutti gli utenti per la tabella admin */
    public function getAllUsers() :array {
        $stmt = $this->db->prepare("SELECT id_utente, nome, cognome, email, ruolo, stato, data_iscrizione FROM utenti ORDER BY cognome, nome");
        if (!$stmt) return [];

        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    /*Funzione per disattivare un utente */
    public function banUser(int $userId): bool {
        $stmt = $this->db->prepare("UPDATE utenti SET stato = 'disattivato' WHERE id_utente = ?");
        if (!$stmt) return false;

        $stmt->bind_param("i", $userId);

        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    /*Funzione per riattivare un utente */
    public function unbanUser(int $userId) {
        $stmt = $this->db->prepare("UPDATE utenti SET stato = 'attivo' WHERE id_utente = ?");
        if (!$stmt) return false;

        $stmt->bind_param("i", $userId);
        
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    /* Funzione per restituire le statistiche generali per il pannello admin */
    public function getAdminStats(): array {
        $stmt = $this->db->prepare("SELECT 
            (SELECT COUNT(*) FROM gruppi) AS totale_gruppi,
            (SELECT COUNT(*) FROM messaggi) AS totale_messaggi,
            (SELECT COUNT(*) FROM utenti WHERE ruolo = 'user') AS totale_studenti,
            (SELECT COUNT(*) FROM utenti WHERE ruolo = 'user' AND stato = 'attivo') AS studenti_attivi,
            (SELECT COUNT(*) FROM utenti WHERE ruolo = 'user' AND stato = 'disattivato') AS studenti_disattivati");
        
        $defaultArray = [
            'totale_gruppi' => 0,
            'totale_messaggi' => 0,
            'totale_studenti' => 0,
            'studenti_attivi' => 0,
            'studenti_disattivati' => 0,
        ];
        
        if(!$stmt){
            return $defaultArray;
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $stats = $result ? $result->fetch_assoc() : [];
        $stmt->close();

        return array_merge($defaultArray, $stats);
    }

    /* Funzione che restituisce tutti i gruppi con le relative informazioni per l'admin */
    public function getGroupsForAdmin(): array {
        $stmt = $this->db->prepare("SELECT g.id_gruppo, g.titolo, g.corso, g.tipo, g.stato, g.data_creazione, g.membri_max, CONCAT(u.nome, ' ', u.cognome) AS creatore, COUNT(DISTINCT i.id_iscrizione) AS partecipanti, COUNT(DISTINCT m.id_messaggio) AS messaggi
        FROM gruppi g
        LEFT JOIN utenti u ON g.id_creatore = u.id_utente
        LEFT JOIN iscrizioni i ON g.id_gruppo = i.id_gruppo AND i.stato = 'confermato'
        LEFT JOIN messaggi m ON g.id_gruppo = m.id_gruppo
        GROUP BY g.id_gruppo ORDER BY g.data_creazione DESC");

        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        $res = $stmt->get_result();
        $groups = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();

        return $groups;
    }

    /* Funzione che restituisce i messaggi che sono stati inviati nella chat di un gruppo */
    public function getMessagesForAdmin(int $idGruppo): array {
        $stmt = $this->db->prepare("SELECT m.data_invio, u.nome, u.cognome, m.corpo_messaggio
            FROM messaggi m JOIN utenti u ON m.id_utente = u.id_utente WHERE m.id_gruppo = ? ORDER BY m.data_invio ASC");

        if (!$stmt) {
            return [];
        }

        $stmt->bind_param("i", $idGruppo);
        $stmt->execute();
        $res = $stmt->get_result();
        $messages = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();

        return $messages;
    }

    // Controllo se è gia presente l'email 
    public function emailExists(string $email): bool {
        $email = trim(strtolower($email));
        $stmt = $this->db->prepare("SELECT id_utente FROM utenti WHERE email = ? LIMIT 1");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        $trovata = ($res && $res->num_rows > 0);
        $stmt->close();
        return $trovata;
    }

    public function getUserByEmail(string $email): ?array {
        $email = trim(strtolower($email));
        $stmt = $this->db->prepare(" SELECT id_utente, nome, cognome, email, password, ruolo, stato FROM utenti WHERE email = ? LIMIT 1");
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows == 1) {
            $utente = $res->fetch_assoc();
            $stmt->close();
            return $utente;
        }
        $stmt->close();
        return null;
    }

    public function getProfileInfo(string $idUtente): ?array {
        $stmt = $this->db->prepare(" SELECT nome, cognome, email, data_iscrizione FROM utenti WHERE id_utente = ? LIMIT 1");
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows == 1) {
            $utente = $res->fetch_assoc();
            $stmt->close();
            return $utente;
        }
        $stmt->close();
        return null;
    }

    /*
        Crea un nuovo utente.
        Ritorna:
            -1 se l'email è già presente,
            l'id utente se va tutto bene,
            altrimenti false se errore
    */
    public function createUser( string $nome, string $cognome, string $email, string $passwordPlain, string $ruolo = "user"
    ) {
        $email = trim(strtolower($email));
        if ($this->emailExists($email)) {
            return -1;
        }

        $passwordHash = password_hash($passwordPlain, PASSWORD_DEFAULT);
        $stato = "attivo";
        $stmt = $this->db->prepare("INSERT INTO utenti (nome, cognome, email, password, ruolo, stato)  VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssss", $nome, $cognome, $email, $passwordHash, $ruolo, $stato);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }

        $idNuovoUtente = $this->db->insert_id;
        $stmt->close();
        return $idNuovoUtente;
    }

    // Login: controllo utente dall'email, password e stato account
    public function checkLogin(string $email, string $passwordPlain): ?array {
        $utente = $this->getUserByEmail($email);
        if (!$utente) {
            return null;
        }
        if (!password_verify($passwordPlain, $utente["password"])) {
            return null;
        }

        if (($utente["stato"] ?? "") === "disattivato") {
            return null;
        }
        unset($utente["password"]);
        return $utente;
    }

    // Iscrizione al gruppo, verifica se il gruppo esiste, se è pieno o se si è già iscritti
    public function joinGroup(int $idUtente, int $idGruppo, string $ruolo="Membro") {
    $details = $this->getGroupDetails($idGruppo);
    if (empty($details)) {
        return -1; // Gruppo inesistente
    }

    if ($this->countGroupParticipants($idGruppo) >= $details['membri_max']) {
        return 1; // Codice per "Gruppo Pieno"
    }

    try {
        if($ruolo == "Fondatore") {
            $statoIniziale = "confermato";
        } else {
            $tipologia = $details['tipo'];
            $statoIniziale = ($tipologia == "Elaborato") ? "in_attesa" : "confermato"; //Se il gruppo è di elaborato inizialmente lo stato di iscrizione è "in attesa", altrimenti "confermato"
        }
        
        $stmt = $this->db->prepare("INSERT INTO iscrizioni (id_utente, id_gruppo, stato, ruolo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $idUtente, $idGruppo, $statoIniziale, $ruolo);
        
        if ($stmt->execute()) {
            $stmt->close();
            return $statoIniziale == "confermato" ? 0 : 3; // Restituisce lo stato dell'iscrizione
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            return 2; // Codice per "Già iscritto"
        }
    }
        return -1; // Errore generico
}

    public function createGroup(string $tipo, string $titolo, string $corso, string $descrizione, string $luogo, string $orario, int $maxMembri, int $idCreatore) {
        $stmt = $this->db->prepare("INSERT INTO gruppi (tipo, titolo, corso, descrizione, luogo_incontro, orario_incontro, membri_max, id_creatore, stato) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'attivo')");

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssssii", $tipo, $titolo, $corso, $descrizione, $luogo, $orario, $maxMembri, $idCreatore);
        
        if ($stmt->execute()) {
            $idNuovoGruppo = $stmt->insert_id; 
            $stmt->close(); 
            
            return $this->joinGroup($idCreatore, $idNuovoGruppo, "Fondatore") === 0;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function getGroupDetails(int $idGruppo) {
        $stmt = $this->db->prepare("SELECT id_gruppo, titolo, corso, descrizione, tipo, luogo_incontro, orario_incontro, data_creazione, membri_max
                                    FROM gruppi WHERE id_gruppo = ?");
        
        if (!$stmt) {
                return false;
            }
        
        $stmt->bind_param("i", $idGruppo);
        $stmt->execute();
        $groupDetails = $stmt->get_result();

        $stmt->close();
        
        return $groupDetails->fetch_assoc() ?? [];
    }

    public function findGroups(string $query) {
        $query = "%$query%"; // I % per considerare qualsiasi carattere agli estremi del termine cercato

        $stmt = $this->db->prepare("SELECT * FROM gruppi WHERE titolo LIKE ?");
        $stmt->bind_param("s", $query);

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countGroupParticipants(int $idGruppo) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as totale FROM iscrizioni WHERE id_gruppo = ? AND stato = 'confermato'");
        $stmt->bind_param("i", $idGruppo);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $stmt->close();

        return (int)($row['totale'] ?? 0);
    }

    public function updateUserEmail(int $userId, string $email) {
    /*
        Inanzitutto controllo che la nuova email non sia già usata da un altro studente.
    */
    $checkMail = $this->db->prepare("SELECT id_utente FROM utenti WHERE email = ? AND id_utente <> ? LIMIT 1");
    if (!$checkMail) {
        return false;
    }
    $checkMail->bind_param("si", $email, $userId);
    $checkMail->execute();

    $resOfCheck = $checkMail->get_result();
    if ($resOfCheck && $resOfCheck->num_rows > 0) { // Se trovo almeno una riga, significa che un altro utente ha già quella email
        $checkMail->close();
        return -1;
    }
    $checkMail->close();

    /*
        Dopo il controllo procedo con l'aggiornamento dei dati dell'utente
    */
    $stmt = $this->db->prepare("UPDATE utenti SET email = ? WHERE id_utente = ?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("si",$email, $userId);

    $success = $stmt->execute();
    $stmt->close();
    return $success;
    }

    /*
        Funzione per cambiare la password
    */
    public function updatePassword($userId, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE utenti SET password = ? WHERE id_utente = ?");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("si", $hash, $userId);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function getMessages(int $idGruppo) {
        $stmt = $this->db->prepare("SELECT m.data_invio, u.nome, u.cognome, m.corpo_messaggio 
                                    FROM messaggi m 
                                    JOIN utenti u ON m.id_utente = u.id_utente
                                    WHERE m.id_gruppo = ?
                                    ORDER BY m.data_invio ASC");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        
        return $messages;
    }

    public function sendMessage(int $idUtente, int $idGruppo, string $messaggio) {
        $stmt = $this->db->prepare("INSERT INTO messaggi (id_utente, id_gruppo, corpo_messaggio) VALUES (?, ?, ?)");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("iis", $idUtente, $idGruppo, $messaggio);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }

    public function isUserInGroup(int $idUtente, $idGruppo) {
        $query = "SELECT * FROM iscrizioni WHERE id_utente = ? AND id_gruppo = ? AND stato='confermato'"; 
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idUtente, $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->num_rows > 0;
    }

    public function quitGroup(int $idUtente, int $idGruppo) {
        $stmt = $this->db->prepare("DELETE FROM iscrizioni WHERE id_utente = ? AND id_gruppo = ?");
        
        $stmt->bind_param("ii", $idUtente, $idGruppo);
        
        return $stmt->execute();
    }

    public function getPendingRequests(int $idFondatore) {
        $stmt = $this->db->prepare("SELECT u.nome, u.cognome, g.titolo, g.tipo, i.id_utente, i.id_gruppo, i.data_adesione 
                                    FROM iscrizioni i
                                    JOIN utenti u ON i.id_utente = u.id_utente
                                    JOIN gruppi g ON i.id_gruppo = g.id_gruppo
                                    WHERE g.id_creatore = ? AND i.stato = 'in_attesa'
                                    ORDER BY i.data_adesione ASC");

        $stmt->bind_param("i", $idFondatore);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getSentRequests(int $idUtente) {
        $stmt = $this->db->prepare("SELECT g.titolo, g.id_gruppo, g.tipo, i.data_adesione, i.stato
                                    FROM iscrizioni i
                                    JOIN gruppi g ON i.id_gruppo = g.id_gruppo
                                    WHERE i.id_utente = ? AND i.stato = 'in_attesa'
                                    ORDER BY i.data_adesione DESC");

        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function manageRequest(int $idUtente, int $idGruppo, string $azione) {
        if ($azione == 'accetta') {
            $query = "UPDATE iscrizioni SET stato = 'confermato' 
                    WHERE id_utente = ? AND id_gruppo = ? AND stato = 'in_attesa'";
        } else {
            $query = "DELETE FROM iscrizioni WHERE id_utente = ? AND id_gruppo = ?";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idUtente, $idGruppo);
        
        $res = $stmt->execute();
        $stmt->close();
        
        return $res;
    }

    public function getGroupMembers($idGruppo) {
        $stmt = $this->db->prepare("SELECT  u.id_utente, u.nome, u.cognome, u.email, i.ruolo, i.data_adesione 
                                    FROM utenti u 
                                    JOIN iscrizioni i ON u.id_utente = i.id_utente 
                                    WHERE i.id_gruppo = ? 
                                    AND i.stato = 'confermato' 
                                    ORDER BY i.data_adesione DESC");
        $stmt->bind_param("i", $idGruppo);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>