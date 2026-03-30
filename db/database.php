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
    $stmt = $this->db->prepare("SELECT tipo, titolo, corso FROM Gruppi");

    $stmt->execute();
    $res = $stmt->get_result();
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    /*Funzione per richiamare dal DB i gruppi a cui l'utente loggato è iscritto */

    public function getPersonalGroups(int $userId) :array {
        $stmt = $this->db->prepare("SELECT  FROM Gruppi G 
                                    JOIN Iscrizioni I ON G.id_gruppo = I.id_gruppo 
                                    JOIN Utenti U ON U.id_utente=I.id_utente
                                    WHERE U.id_utente = ?");
        if ($stmt) return false;

        $stmt->bind_param("i", $userId);

        $stmt->execute();
        $res = stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    /*Funzione per richiamare tutti gli utenti dell'applicazione
    per la visione da parte dell'Admin sulla sua dashboard */
    public function getAllUsers() :array {
        $stmt = $this->db->prepare("SELECT nome_cognome, email FROM Utenti");
        if ($stmt) return false;

        $stmt->execute();
        $res = stmt->get_result();
        return $res;
    }

    /*Funzione per disattivare un utente, prende in input l'ID utente e il motivo del ban */
    public function banUser(int $userId, string $reason) {
        $stmt = $this->db->prepare("UPDATE utenti SET stato = 'disattivato', motivo_ban = ? WHERE id_utente = ?");
        if ($stmt) return false;

        $stmt->bind_param("is", $userId, $reason);

        $stmt->execute();
    }

    /*Funzione per riattivare un utente, prende in input l'ID utente */
    public function unbanUser(int $userId) {
        $stmt = $this->db->prepare("UPDATE utenti SET stato = 'attivato', motivo_ban = NULL WHERE id_utente = ?");
        if ($stmt) return false;

        $stmt->bind_param("i", $userId);

        $stmt->execute();
    }
}
?>