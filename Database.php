<?php

class CsvManager {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;

        // Crea il file se non esiste
        if (!file_exists($this->filePath)) {
            $file = fopen($this->filePath, 'w');
            fputcsv($file, ['name', 'accept']); // Intestazioni
            fclose($file);
        }
    }

    public function addRecord($name, $accept) {
        // Controlla se il record esiste già
        if ($this->recordExists($name)) {
            return false; // Non aggiungere nulla se il record esiste
        }

        // Aggiungi il nuovo record
        $file = fopen($this->filePath, 'a');
        fputcsv($file, [$name, $accept]);
        fclose($file);
        return true; // Record aggiunto con successo
    }

    public function recordExists($name) {
        $file = fopen($this->filePath, 'r');
        // Salta la prima riga (intestazioni)
        fgetcsv($file, 0, ',', '"', '\\');

        while (($data = fgetcsv($file, 0, ',', '"', '\\')) !== false) {
            if ($data[0] === $name) {
                fclose($file);
                return true; // Record trovato
            }
        }
        fclose($file);
        return false; // Record non trovato
    }
}
