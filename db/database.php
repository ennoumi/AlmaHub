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
    $stmt = $this->db->prepare("SELECT tipo, titolo, corso FROM gruppi");

    $stmt->execute();
    $res = $stmt->get_result();
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    /*Funzione per richiamare dal DB i gruppi a cui l'utente loggato è iscritto */

    public function getPersonalGroups(int $userId) :array {
        $stmt = $this->db->prepare("SELECT tipo, titolo, corso FROM gruppi G 
                                    JOIN iscrizioni I ON G.id_gruppo = I.id_gruppo 
                                    JOIN utenti U ON U.id_utente=I.id_utente
                                    WHERE U.id_utente = ?");
        if (!$stmt) return [];

        $stmt->bind_param("i", $userId);

        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    /*Funzione per richiamare tutti gli utenti dell'applicazione
    per la visione da parte dell'Admin sulla sua dashboard */
    public function getAllUsers() :array {
        $stmt = $this->db->prepare("SELECT nome,cognome, email FROM utenti");
        if (!$stmt) return [];

        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    /*Funzione per disattivare un utente, prende in input l'ID utente e il motivo del ban */
    public function banUser(int $userId, string $reason) {
        $stmt = $this->db->prepare("UPDATE utenti SET stato = 'disattivato', motivo_ban = ? WHERE id_utente = ?");
        if (!$stmt) return false;

        $stmt->bind_param("si", $reason, $userId);

        $stmt->execute();
    }

    /*Funzione per riattivare un utente, prende in input l'ID utente */
    public function unbanUser(int $userId) {
        $stmt = $this->db->prepare("UPDATE utenti SET stato = 'attivo', motivo_ban = NULL WHERE id_utente = ?");
        if (!$stmt) return false;

        $stmt->bind_param("i", $userId);

        $stmt->execute();
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
            
            return joinGroup($idCreatore, $idNuovoGruppo);
        } else {
            $stmt->close();
            return false;
        }
    }

    public function joinGroup(int $idUtente, int $idGruppo) {
        $stmt = $this->db->prepare("INSERT INTO iscrizioni (id_utente, id_gruppo) VALUES (?, ?)");

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ii", $idUtente, $idGruppo);
        
        $success = $stmt->execute();
        
        $stmt->close();
        
        return $success;
    }
}
?>