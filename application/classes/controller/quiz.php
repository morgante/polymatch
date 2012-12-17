<?php defined('SYSPATH') OR die('No Direct Script Access');
 
Class Controller_Quiz extends Controller_Template
{
	public $template = 'wrapper';

	public function action_index()
	{
		$user = Facebook::me();

		if( $user->quiz )
		{
			return $this->action_done();
		}
		else
		{
			return $this->action_do();
		}

		$view = View::factory('test');

		$person->state = 'NY';
		$person->fbc = true;

		$person->save();

		$person->score( 'self', 2);

		$person->score( 1, 4);
		$person->score( 2, 4);
		$person->score( 6, 6);

		$closest = $person->closest();

		// update c and w to match
		$person->c = $closest->c;
		$person->w = $closest->w;
		$person->save();

		$view->c = $closest->c;
		$view->w = $closest->w;

		$this->template->content = $view;

	}
	
	public function action_do()
	{
		// set up user parts
		$user = Facebook::me();
		$person = ORM::factory( 'person' );
		
		// initialize view
		$view = View::factory('quiz');
		
		// pass along view
		$this->template->content = $view;
		
		return;
		
		// pass along politicians
		$view->politicians = $user->state->politicians();
		
		// set the person state and facebook data source
		$person->state = $user->state->abbreviation;
		$person->fbc = true;

		// initial save to database
		$person->save();
		
		$person->score( 'self', 2);

		$person->score( 1, 4);
		$person->score( 2, 4);
		$person->score( 6, 6);

		$closest = $person->closest();

		// update c and w to match
		$person->c = $closest->c;
		$person->w = $closest->w;
		$person->save();

		$view->c = $closest->c;
		$view->w = $closest->w;

	}

	public function action_done()
	{
		$this->template->content = View::factory( 'done_quiz' );
	}

}