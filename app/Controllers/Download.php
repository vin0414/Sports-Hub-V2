<?php

namespace App\Controllers;
use Config\App;

class Download extends BaseController
{
    public function downloadFile()
    {
        $database = getenv('database.default.database');

        // Get connection object and set the charset
        $db = db_connect();
        $timestamp = date('YmdHis');
        $backupDir = FCPATH . 'Upload';

        // Ensure the directory exists, create it if it doesn't
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0777, true);  // Make directory with write permissions
        }
        $backupFileName = $backupDir.'/'.$database. $timestamp . '.sql';

        // Open the backup file for writing
        $file = fopen($backupFileName, 'w');

        // Write the initial SQL for the backup
        fwrite($file, "-- Database backup of {$database} created on {$timestamp}\n\n");

        // Get all table names
        $tables = $db->query("SHOW TABLES")->getResultArray();

        // Loop through each table
        foreach ($tables as $table) {
            $tableName = $table["Tables_in_{$database}"];

            // Write the CREATE TABLE statement
            $createTableQuery = $db->query("SHOW CREATE TABLE `{$tableName}`")->getRow();
            fwrite($file, "\n\n-- Creating table {$tableName} --\n");
            fwrite($file, $createTableQuery->{'Create Table'} . ";\n");

            // Write the INSERT INTO statements for each row in the table
            fwrite($file, "\n\n-- Inserting data into {$tableName} --\n");

            // Fetch the data from the table
            $rows = $db->query("SELECT * FROM `{$tableName}`")->getResultArray();
            foreach ($rows as $row) {
                $columns = array_keys($row);
                $values = array_map(function ($value) {
                    return "'" . addslashes($value) . "'"; // Escape string values
                }, array_values($row));

                $insertQuery = "INSERT INTO `{$tableName}` (" . implode(',', $columns) . ") VALUES (" . implode(',', $values) . ");\n";
                fwrite($file, $insertQuery);
            }
        }

        // Close the backup file
        fclose($file);

        // Serve the file for download
        return $this->downloadBackup($backupFileName);
    }

    private function downloadBackup($filePath)
    {
        // Set headers to force file download
        return $this->response->setHeader('Content-Type', 'application/octet-stream')
            ->setHeader('Content-Disposition', 'attachment; filename="' . basename($filePath) . '"')
            ->setHeader('Content-Length', filesize($filePath))
            ->setBody(file_get_contents($filePath));
    }
}