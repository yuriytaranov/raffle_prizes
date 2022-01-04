<?php

namespace app\console;
use app\Command;

class MigrationCommand extends Command {
    /**
     * Checks if there is a migration storage.
     */
    private function storage()
    {
        $result = Database()->query("show table like :migrations", [":migrations" => 'migrations'])->fetchAll();
        if(empty($result)) {
            Database()->update("create table migrations(id int auto_increment, name varchar(80) not null, created datetime default now(), primary key(id))");
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
            $result = Database()->query("select `name` from `migrations` where `name` = :name", [':name' => $name])->fetchAll();
            if(empty($result)) {
                $sql = file_get_contents($migration);
                Database()->update($sql);
                $id = Database()->insert("insert into `migrations`(`name`) values(:name)", [
                    ':name' => $name,
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