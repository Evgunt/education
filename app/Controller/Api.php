<?php

namespace Controller;


use Model\Post;
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
        if ($request->method === 'POST') {
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
    }
    public function itemAll(Request $request)
    {
        $message = '';
        $item = (new \Model\Catalog)->getItemAll($request->id);
        (new View())->toJSON(['item' => $item, 'message'=>$message]);
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
            if ($request->method == 'POST')
                $response = (new \Model\User)->setImg($request->headers['Authorization']);
            else
                $response = (new \Model\User)->getAllUser($request->headers['Authorization']);
            (new View())->toJSON(['sucsess' => $response]);
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
            $orders = (new \Model\Catalog)->getOrders($request->headers['Authorization']);
            (new View())->toJSON(['orders' => $orders]);
        }
        else
            (new View())->toJSON(['errors' => 'Authorization error']);
    }
    public function search(Request $request)
    {
        if($request->method == 'POST'){
            $response = (new \Model\Catalog())->search($_POST['key']);
            if($response)
                (new View())->toJSON(['search' => $response]);
            else
                (new View())->toJSON(['search' => 'Nothing found']);
        }
    }
    public function setItem(Request $request)
    {
        if($request->method == 'POST'){
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
    }
    public function itemfilter(Request $request)
    {
        if($request->get('type') && $request->get('cats'))
            (new View())->toJSON(['items' => (new \Model\Catalog)->filterItems($request->get('type'), $request->get('cats'))]);
        (new View())->toJSON(['message' => 'Nothing found']);
    }
    public function Lists(Request $request)
    {
        if($request->get('id'))
            (new View())->toJSON(['lists' => (new \Model\Lists)->getList($request->get('id'))]);
        elseif($request->method['POST'])
        {
            $validator = new Validator($request->all(), [
                'title' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);
            if ($validator->fails()) {
                (new View())->toJSON(['errors' => $validator->errors()]);
            }
            (new View())->toJSON(['lists' => (new \Model\Lists)->setList($request->get('id'))]);
        }
        else
            (new View())->toJSON(['lists' => (new \Model\Lists)->getListsAll()]);
    }
}
