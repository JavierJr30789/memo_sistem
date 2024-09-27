<?php
// app/models/usuarios.php

class Usuario {
    private $conn;
    private $table = "usuarios";

    public $id;
    public $nombre;
    public $mail;
    public $clave;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los usuarios
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

        
    }

    // Obtener un solo usuario por ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :idUsuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idUsuarios", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un usuario nuevo
    public function create() {
        $query = "INSERT INTO " . $this->table . " (nombre, mail, clave) VALUES (:nombreUsuario, :mail, :clave)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombreUsuario', $this->nombre);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':clave', $this->clave);
        return $stmt->execute();
    }

    // Actualizar un usuario
    public function update($id) {
        $query = "UPDATE " . $this->table . " SET nombre = :nombreUsuario, mail = :mail, clave = :clave WHERE id = :idUsuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idUsuarios', $id);
        $stmt->bindParam(':nombreUsuario', $this->nombre);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':clave', $this->clave);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :idUsuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idUsuarios', $id);
        return $stmt->execute();
    }
}
?>