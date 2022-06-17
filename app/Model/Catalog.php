<?php

namespace Model;

use Illuminate\Database\Capsule\Manager as DB;

class Catalog
{
    public function getCat()
    {
        return DB::select('SELECT * FROM catalog');
    }
    public function getItems(int $parent)
    {
        return DB::select('SELECT * FROM item WHERE catalog =?', [$parent]);
    }
    public function search(string $key)
    {
        if($key!='')
            return DB::select("SELECT * FROM item WHERE title LIKE '%".$key."%'");
        else
            return 0;
    }
    public function getItemAll(int $id)
    {
        return DB::select("SELECT * FROM item WHERE id=?", [$id]);
    }
    public function setCatalog($token): string
    {
        $user = DB::select('SELECT admin FROM users WHERE token=?', [$token]);
        if($user[0]->admin)
        {
            if(isset($_POST['content']))
                $content = $_POST['content'];
            else
                $content = '';
            $get = DB::insert("INSERT INTO catalog (title, content) VALUES (?,?)", [$_POST['title'], $content]);
            if($get)
                return 'success';
            return 'error';
        }
        return 'Access denied';
    }
    public function setOrder($token): int
    {
        $user = DB::select('SELECT id FROM users WHERE token=?', [$token]);
        if($user[0]->id)
        {
            $get = DB::insert("INSERT INTO orders (ovner, content, total) VALUES (?,?,?) ",
                [$user[0]->id, $_POST['content'], $_POST['total']]);
            if($get)
                return 1;
        }
        return 0;
    }
    public function getOrders($token): array
    {
        $user = DB::select('SELECT id FROM users WHERE token=?', [$token]);
        if($user[0]->id)
        {
            return DB::select('SELECT * FROM orders WHERE ovner=?', [$user[0]->id]);
        }
        return ['message'=>'error'];
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
    public function setItemCats($token): string
    {
        $user = DB::select('SELECT admin FROM users WHERE token=?', [$token]);
        if($user[0]->admin)
        {
            $img = self::setImg();
            if($img=='error')
                $img = null;
            $cats = DB::select('SELECT title FROM catalog WHERE id=?', [$_POST['cats']]);
            if($cats)
            {
                $get = DB::insert("INSERT INTO item (catalog, title, content, price, img) VALUES (?,?,?,?) ",
                    [$_POST['cats'], $_POST['title'], $_POST['content'], $_POST['price'], $img]);
                if($get)
                    return 'success';
                else 
                    return 'error';
            }
            else
                return 'Unknown category';
        }
        return 'Access denied';
    }
    public function filterItems($type, $cats)
    {
        switch($type){
            case 'exp':
                $request = DB::select('SELECT * FROM item WHERE catalog = ? ORDER BY price DESC', [$cats]);
                break;
            case 'chip':
                $request = DB::select('SELECT * FROM item WHERE catalog = ? ORDER BY price', [$cats]);
                break;
        }
        return $request;
    }
}
