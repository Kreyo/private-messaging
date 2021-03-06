<?php

class Controller_Users extends Controller_Template
{

	public function action_login()
  {
    $view = View::forge('users/login');
    $form = Form::forge('login');
    $auth = Auth::instance();
    $form->add('username', 'Username:');
    $form->add('password', 'Password:', array('type' => 'password'));
    $form->add('submit', ' ', array('type' => 'submit', 'value' => 'Login'));
    if($_POST)
    {
        if($auth->login(Input::post('username'), Input::post('password')))
        {
          Session::set_flash('success', 'Successfully logged in! Welcome '.$auth->get_screen_name());
          Response::redirect('messages/');
        }
        else
        {
          Session::set_flash('error', 'Username or password incorrect.');
        }
    }
    $view->set('form', $form, false);
    $this->template->title = 'User &raquo; Login';
    $this->template->content = $view;
  }

	public function action_logout()
	{
    $auth = Auth::instance();
    $auth->logout();
    Session::set_flash('success', 'Logged out.');
    Response::redirect('messages/');
  }

	public function action_register()
	{
    $auth = Auth::instance();
    $view = View::forge('users/register');
    $form = Fieldset::forge('register');
    Model_User::register($form);
    if($_POST) { 
      $form->repopulate();
      $result = Model_User::validate_registration($form , $auth);
      if($result['e_found'])
      {
        $view->set('errors', $result['errors'], false);
      }
      else
    {
        $register_message = Model_Message::forge(array(
            'name' => 'Admin',
            'recipient' => $form->username,
            'message' => 'Welcome to our neat little messaging system!',
        ));
        $register_message->save();
        Session::set_flash('success', 'User created.');
        Response::redirect('./');
    }
    }
    $view->set('reg', $form->build(), false);
    $this->template->title = 'User &raquo; Register';
    $this->template->content = $view;
	}
    public function action_profile(){
        $auth = Auth::instance();
        $view = View::forge('users/profile');
        $this->template->title = 'Your profile';
        $this->template->content = $view;
        if (\Input::method() === 'POST'){
            $new_data=array('email' => $_POST['email_change']);
            $auth->update_user($new_data);
        }
    }
}
