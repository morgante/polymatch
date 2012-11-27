
<?php defined('SYSPATH') OR die('No Direct Script Access');
 
Class Controller_Quiz extends Controller_Template
{
	public $template = 'quiz';
	
    public function action_index()
    {
		$facebook = Facebook::factory();
		$facebook->login();
		
		$me = Model_FBUser::fetch( 563405813 );
				
    }

}