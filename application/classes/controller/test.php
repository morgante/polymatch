
<?php defined('SYSPATH') OR die('No Direct Script Access');
 
Class Controller_Test extends Controller_Template
{
	public $template = 'test';
	
    public function action_index()
    {
		$user = ORM::factory('person', 3);
		
		$state = ORM::factory( 'state', 'VT' );
		
		$politician = $state->politicians->find();
		
		$score = $politician->scores->find();
		
		Utils::debug( $score->person->scores->find_all() );
	
        $this->template->c = 4;
		$this->template->w = 3;
    }
}