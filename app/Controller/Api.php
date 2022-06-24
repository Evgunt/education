<?php

namespace Controller;


use Model\Post;
use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Api
{
    public function catalog(Request $request): void
    {
        $cats = (new \Model\Catalog)->getItems($request->id);
        (new View())->toJSON($cats);
    }
    public function setCatalog(Request $request)
    {
        if(isset($_POST['title'])) {
            $validator = new Validator($request->all(), [
                'title' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);
            if ($validator->fails()) {
                (new View())->toJSON(['errors' => $validator->errors()]);
            }
            (new View())->toJSON(['message' => (new \Model\Catalog)->setCatalog($request->headers['Authorization'])]);
        }
        else
            (new View())->toJSON(['errors' => 'Field "title" not found']);
    }
    public function itemAll(Request $request)
    {
        $item = (new \Model\Catalog)->getItemAll($request->id);
        (new View())->toJSON(['item' => $item]);
    }
    public function signup(Request $request): string
    {
        $validator = new Validator($request->all(), [
            'name' => ['required'],
            'login' => ['required', 'unique:users,login'],
            'password' => ['required'],
            'email' => ['required'],
        ], [
            'required' => 'Поле :field пусто',
            'unique' => 'Поле :field должно быть уникально'
        ]);

        if($validator->fails())
            (new View())->toJSON(['errors' => $validator->errors()]);
        

        if (User::create($request->all()))
            (new View())->toJSON(['user' => 'sucsess']);
        else
            (new View())->toJSON(['user' => 'error']);
    }
    public function login(Request $request): void
    {
        if (Auth::attempt($request->all())) {
            (new View())->toJSON((new \Model\User)->setToken());
        }
    }
    public function Personal(Request $request)
    {
        if(isset($request->headers['Authorization'])) {
            $orders = '';
            if ($request->method == 'POST')
                $response = (new \Model\User)->setImg($request->headers['Authorization']);
            else
            {
                $orders = (new \Model\Catalog)->getOrders($request->headers['Authorization']);
                $response = (new \Model\User)->getAllUser($request->headers['Authorization']);
            }
            (new View())->toJSON(['user' => $response, 'orders' => $orders]);
        }
        else
            (new View())->toJSON(['errors' => 'Authorization error']);

    }
    public function orders(Request $request)
    {
        if(isset($request->headers['Authorization'])) {
            if ($request->method == 'POST') {
                $response = (new \Model\Catalog)->setOrder($request->headers['Authorization']);
                if ($response)
                    (new View())->toJSON(['message' => 'success']);
                else
                    (new View())->toJSON(['message' => 'error']);
            }
        }
        else
            (new View())->toJSON(['errors' => 'Authorization error']);
    }
    public function search(Request $request)
    {
        $response = (new \Model\Catalog())->search($_POST['key']);
        if($response)
            (new View())->toJSON(['search' => $response]);
        else
            (new View())->toJSON(['search' => 'Nothing found']);
    }
    public function setItem(Request $request)
    {
        if(isset($_POST['title'])) {
            $validator = new Validator($request->all(), [
                'title' => ['required'],
                'price' => ['required'],
                'cats' => ['required']
            ], [
                'required' => 'Поле :field пусто',
            ]);
            if ($validator->fails()) {
                (new View())->toJSON(['errors' => $validator->errors()]);
            }
            (new View())->toJSON(['message' => (new \Model\Catalog)->setItemCats($request->headers['Authorization'])]);
        }
    }
    public function itemFilter(Request $request)
    {
        if($request->get('type') && $request->get('cats'))
            (new View())->toJSON(['items' => (new \Model\Catalog)->filterItems($request->get('type'), $request->get('cats'))]);
        (new View())->toJSON(['message' => 'Nothing found']);
    }
    public function Lists(Request $request)
    {
        $id = $request->get('id');
        if($request->method == "POST")
        {
            $validator = new Validator($request->all(), [
                'title' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);
            if ($validator->fails()) {
                (new View())->toJSON(['errors' => $validator->errors()]);
            }
            (new View())->toJSON(['lists' => (new \Model\Lists)->setList($request->headers['Authorization'])]);
        }
        elseif(isset($id) && $id!='')
            (new View())->toJSON(['lists' => (new \Model\Lists)->getList($request->get('id'))]);
        else
            (new View())->toJSON(['lists' => (new \Model\Lists)->getListsAll()]);
    }
    public function editCat(Request $request)
    {
        $validator = new Validator($request->all(), [
            'id' => ['required'],
            'title' => ['required'],
        ], [
            'required' => 'Поле :field пусто',
        ]);
        if ($validator->fails()) 
            (new View())->toJSON(['errors' => $validator->errors()]);
        (new View())->toJSON(['Catalog' => (new \Model\Catalog)->editCats($request->headers['Authorization'])]);
    } 
    public function editItem(Request $request)
    {
        $validator = new Validator($request->all(), [
            'id' => ['required'],
            'title' => ['required'],
            'price' => ['required'],
            'cats' => ['required'],
        ], [
            'required' => 'Поле :field пусто',
        ]);
        if ($validator->fails()) 
            (new View())->toJSON(['errors' => $validator->errors()]);
        (new View())->toJSON(['items' => (new \Model\Catalog)->editItems($request->headers['Authorization'])]);
    } 
    public function editList(Request $request)
    {
        $validator = new Validator($request->all(), [
            'id' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
        ], [
            'required' => 'Поле :field пусто',
        ]);
        if ($validator->fails()) 
            (new View())->toJSON(['errors' => $validator->errors()]);
        (new View())->toJSON(['lists' => (new \Model\Lists)->editList($request->headers['Authorization'])]);
    }
    public function dellCats(Request $request)
    {
        $id = $request->get('id');
        (new View())->toJSON(['Cats' => (new \Model\Catalog)->dellCats($request->headers['Authorization'], $id)]);
    }
    public function dellItems(Request $request)
    {
        $id = $request->get('id');
        (new View())->toJSON(['items' => (new \Model\Catalog)->dellItems($request->headers['Authorization'], $id)]);
    }
    public function dellList(Request $request)
    {
        $id = $request->get('id');
        (new View())->toJSON(['items' => (new \Model\Lists)->dellList($request->headers['Authorization'], $id)]);
    }
}
