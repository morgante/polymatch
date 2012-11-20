
<?php defined('SYSPATH') OR die('No Direct Script Access');
 
Class Controller_Test extends Controller_Template
{
	public $template = 'test';
	
    public function action_index()
    {
		$user = ORM::factory('person', 5141);
		
		$user->score('Obama', 2);
		
		Utils::debug( $user->score('Obama') );
	
        $this->template->c = 4;
		$this->template->w = 3;
    }

	public function action_match()
    {
		// $user = ORM::factory('person');
		// 
		// $user->score('self', 3);
		// $user->score( 'Obama', 5);
		// $user->score( 2, 3);
		// $user->score( 7, 7);
		// $user->score( 2131, 7);
		// $user->score( 1111, 1);
		
		$user_id = $this->request->param('id');
		
		echo $user_id;
		
		// $user = ORM::factory( 'person', $user_id);
		// 
		// $match = $user->closest();
		// 
		// Utils::debug( $user->scores(), $match->scores(), $user_id );
				
        $this->template->c = $user_id;
		$this->template->w = 3;
    }

}