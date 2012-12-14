<?php defined('SYSPATH') OR die('No Direct Script Access');
 
Class Controller_Quiz extends Controller_Template
{
	public $template = 'wrapper';
	
    public function action_index()
    {
		$me = Facebook::user(563405813);
				
		if( $me->quiz )
		{
			return $this->action_done_quiz();
		}
		
		$view = View::factory('quiz');
		
		$view->quiz = false;
		$view->state = 'BOB';
		
		$this->template->content = $view;
				
    }

   public function action_done_quiz()
    {
		$this->template->content = View::factory( 'done_quiz' );
    }

}