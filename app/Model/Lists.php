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
   public function setImg(): string
    {
        if (isset($_FILES['img']) && $_FILES['img']['error'] != 4) {
            $filename = str_replace(' ','',basename($_FILES['img']['name']));
            move_uploaded_file($_FILES["img"]["tmp_name"], '../public/upload/' . $filename);
            return $filename;
        }
        return 'error';
    }
   public function setList($token)
   {
     $user = DB::select('SELECT admin FROM users WHERE token=?', [$token]);
     if($user[0]->admin)
     {
		$img = self::setImg();
		if($img=='error')
			$img = null;
		$response = DB::insert("INSERT INTO lists (title, content, img) VALUES (?,?,?)",
		[$_POST['title'], $_POST['content'], $img]);
		if($response)
			return 'sucsess';
		return 'error';
     }
     return 'error';
   }
}
