<?php

namespace Model;

use Illuminate\Database\Capsule\Manager as DB;

class Lists
{
   public function getList($id): array
   {
        if($id)
            return DB::select("SELECT * FROM lists WHERE id=?", [$id]);
        return ['message' => 'error'];
   }
   public function getListsAll()
   {
        return DB::select("SELECT * FROM lists");
   }
   public function setList()
   {
        $response = DB::insert("INSERT INTO lists (title, content, img) VALUES (?,?,?)", [$_POST['title'], $_POST['content'], $_POST["img"]]);
        if($response)
            return 'sucsess';
        return 'error';
   }
}
