<?php

namespace app\console;
use app\Command;

class MigrationCommand extends Command {
    /**
     * Checks if there is a migration storage.
     */
    private function storage()
    {
        $result = Database()->query("
            SELECT table_name FROM information_schema.tables
            WHERE table_schema='public' AND table_name=:migrations
        ", ["migrations" => 'migrations'])->fetchObject();
        if(empty($result)) {
            Database()->update("
                create table migrations
                (
                    id      serial
                        constraint migrations_pk
                            primary key,
                    name    varchar not null,
                    created timestamp default now()
                )
            ");
        }
    }

    /**
     * Search migrations in path and apply to database.
     */
    public function handle()
    {
        $this->storage();
        $migrations = glob(__DIR__ . "/../db/migrations/*.sql");
        array_walk($migrations, function($migration){
            $name = basename($migration);
            $result = Database()->query("select name from migrations where name = :name", [':name' => $name])->fetchAll();
            if(empty($result)) {
                $sql = file_get_contents($migration);
                Database()->exec($sql);
                $id = Database()->insert("insert into migrations(name) values(:name)", [
                    'name' => $name,
                ]);
                $this->writeln("Migration {$name} applied, id = {$id}");
            }
        });
    }

    /**
     * Creates new empty migration file.
     */
    public function create($name)
    {
        $time = date('Y-m-d-H-s-i', time());
        $file = __DIR__ . "/../db/migrations/{$time}_{$name}.sql";
        file_put_contents($file, "-- migration {$name} created {$time}");
        chmod($file, 0666);
        $this->writeln("Migration created {$file}");
    }
}