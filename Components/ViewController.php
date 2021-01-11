<?php 
namespace Components;

if (!session_id()) {
    @session_start();
}

use \League\Plates\Engine;
use \Components\QueryBuilder;
use \Tamtamchik\SimpleFlash\Flash;

/**
 * Controlls page rendering
 */
class ViewController
{
    /**
     * League Plates Engine object
     * @var Engine
     */
    private $engine = null;

    /**
     * QueryBuilder object
     * @var QueryBuilder
     */
    private $db = null;

    public function __construct()
    {
        $this->engine = new Engine('../templates');
        $this->db = new QueryBuilder;
    }

    /**
     * Renders main page (userslist)
     */
    public function users()
    {
        $users = $this->db->getAll('users');
        echo $this->engine->render('userslist', ['users' => $users]);
    }

    /**
     * Create new user form
     */
    public function create_user()
    {
        echo $this->engine->render('createtemplate');
    }

    /**
     * Add new user to DB, then redirects to main page
     */
    public function create_user_handler()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];

        $this->db->insert(['username' => $username, 'email' => $email], 'users');

        header('Location: /');
    }

    /**
     * Renders Edit User form
     * @param array $params
     */
    public function edit_user($params)
    {
        $user = $this->db->getOne('users', $params['id']);
        echo $this->engine->render('edittemplate', ['user' => $user]);
    }

    /**
     * Update user information in DB, then redirects to main page
     */
    public function edit_user_handler()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        $successful = $this->db->update(['username' => $username, 'email' => $email], $id, 'users');

        if ($successful) {
            Flash::message('User updated', 'success');
        } else {
            Flash::message('Something went wrong', 'error');
        }

        header('Location: /');
    }

    /**
     * Deletes user from DB by id. Then redirects to main page
     * @param array $params
     */
    public function delete_user($params)
    {
        $deleted = $this->db->delete('users', $params['id']);

        if ($deleted) {
            Flash::message('User deleted', 'success');
        } else {
            Flash::message('Unable to delete user', 'error');
        }

        header('Location: /');
    }

    /**
     * Renders 'About' template
     */
    public function about()
    {
        echo $this->engine->render('abouttemplate');
    }

    /**
     * if page not found, renders error 404 message
     */
    public function error404()
    {
        echo $this->engine->render('404template');
    }

    /**
     * if request method is not allowed, renders error 405 message
     */
    public function error405()
    {
        echo $this->engine->render('wrongmethod');
    }
}