<?php defined('SYSPATH') OR die('No Direct Script Access');
 
Class Controller_Quiz extends Controller_Template
{
	public $template = 'wrapper';
	
    public function action_index()
    {
		$user = Facebook::user(563405813);
		$person = ORM::factory( 'person' );
				
		if( $user->quiz )
		{
			return $this->action_done_quiz();
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

   public function action_done_quiz()
    {
		$this->template->content = View::factory( 'done_quiz' );
    }

}