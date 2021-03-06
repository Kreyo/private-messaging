<?php
class Controller_Messages extends Controller_Template 
{

	public function action_index()
	{

        $total_posts = DB::count_records('messages');

        $config = array(
            'pagination_url' => '/messages/',
            'total_items' => $total_posts,
            'per_page'       => 6,
            'uri_segment'    => 2,
        );
        $pagination = Pagination::forge('index_pagination', $config);
		$data['messages'] = Model_Message::find('all', array(

            'limit' => 5,
            'offset' => Pagination::get('offset')
        ));
		$this->template->title = "Messages";
        $data['pagination'] = $pagination->render();
		$this->template->content = View::forge('messages/index', $data);

	}
    public function action_sent()
    {
        $total_posts = DB::count_records('messages');

        $config = array(
            'pagination_url' => '/messages/sent',
            'total_items' => $total_posts,
            'per_page'       => 6,
            'uri_segment'    => 3,
        );
        $pagination = Pagination::forge('sent_pagination',$config);
        $data['messages'] = Model_Message::find('all', array(

            'limit' => 5,
            'offset' => Pagination::get('offset')
        ));

        $this->template->title = "Sent Messages";
        $data['pagination'] = $pagination->render();
        $this->template->content = View::forge('messages/sent', $data);

    }
    public function action_new()
    {
        $total_posts = DB::count_records('messages');

        $config = array(
            'pagination_url' => '/messages/new',
            'total_items' => $total_posts,
            'per_page'       => 6,
            'uri_segment'    => 3,
        );
        $pagination = Pagination::forge('new_pagination', $config);
		$data['messages'] = Model_Message::find('all', array(

            'limit' => 5,
            'offset' => Pagination::get('offset')
        ));

        $this->template->title = "New Messages";
        $data['pagination'] = $pagination->render();
        $this->template->content = View::forge('messages/new', $data);

    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('Messages');

		if ( ! $data['message'] = Model_Message::find($id))
		{
			Session::set_flash('error', 'Could not find message #'.$id);
			Response::redirect('Messages');
		}

		$this->template->title = "Message";
		$this->template->content = View::forge('messages/view', $data);
        $data['is_read'] = TRUE;
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Message::validate('create');
			
			if ($val->run())
			{
				$message = Model_Message::forge(array(
					'name' => Auth::instance()->get_screen_name(),
                    'recipient' => Input::post('recipient'),
					'message' => Input::post('message'),
				));

				if ($message and $message->save())
				{
					Session::set_flash('success', 'Added message #'.$message->id.'.');

					Response::redirect('messages');
				}

				else
				{
					Session::set_flash('error', 'Could not save message.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Messages";
		$this->template->content = View::forge('messages/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Messages');

		if ( ! $message = Model_Message::find($id))
		{
			Session::set_flash('error', 'Could not find message #'.$id);
			Response::redirect('Messages');
		}

		$val = Model_Message::validate('edit');

		if ($val->run())
		{
			$message->name = Input::post('name');
            $message->recipient = Input::post('recipient');
			$message->message = Input::post('message');

			if ($message->save())
			{
				Session::set_flash('success', 'Updated message #' . $id);

				Response::redirect('messages');
			}

			else
			{
				Session::set_flash('error', 'Could not update message #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$message->name = $val->validated('name');
				$message->message = $val->validated('message');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('message', $message, false);
		}

		$this->template->title = "Messages";
		$this->template->content = View::forge('messages/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('Messages');

		if ($message = Model_Message::find($id))
		{
			$message->delete();

			Session::set_flash('success', 'Deleted message #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete message #'.$id);
		}

		Response::redirect('messages');

	}


}