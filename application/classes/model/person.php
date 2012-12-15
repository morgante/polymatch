<?php

class Model_Person extends ORM
{

	protected $_belongs_to = array(
		'state' => array( 'foreign_key' => 'state' )
	);
	
	protected $_has_many = array(
		'scores' => array( 'model' => 'score', 'foreign_key' => 'person_id' ),
	 );
	
	private $all_scores = array();
	
	public function scores()
	{
		if( !isset( $this->all_scores ) || count( $this->all_scores ) < 1 )
		{
			$this->all_scores['self'] = (int) $this->self;
			
			foreach( $this->scores->find_all() as $score )
			{
				$this->all_scores[ $score->politician_id ] = (int) $score->score;
			}
		}
				
		return $this->all_scores;
	}
	
	/**
	 * Helper function to get & set scores 
	 **/
	public function score( $politician, $score = null )
	{
		if( isset( $score ) )
		{
			return $this->set_score( $politician, $score );
		}
		else
		{
			return $this->get_score( $politician );
		}
	}
	
	/**
	 * Set the person's score of a particular politician 
	 **/
	public function set_score( $politician, $n )
	{
		if( $politician == 'self' )
		{
			$politician_id = 'self';
		}
		else
		{
			$politician_id = Model_Politician::get_id( $politician );
		}
		
		// first set our internal database
		$this->all_scores[ $politician_id ] = (int) $n;
		
		if( $politician_id == 'self' )
		{
			$this->self = $n;
			$this->save();
		}
		else
		{
			$query = DB::select()->from('scores')->where('politician_id', '=', $politician_id)->where('person_id', '=', $this->id);

			if( $query->execute()->count() == 0 ){
				// no existing score, add it
				$score = ORM::factory('score');
				$score->politician_id = $politician_id;
				$score->person_id = $this->id;
			}
			
			$score->score = $n;
			$score->save();
		}
				
		return (int) $n;
	}
	
	/**
	 * Get the person's score of a particular politician 
	 **/
	public function get_score( $politician )
	{
		if( $politician == 'self' )
		{
			return $this->score;
		}
		
		$politician_id = Model_Politician::get_id( $politician );
		
		// first check our internal database
		if( isset( $this->all_scores[ $politician_id ] ) )
		{
			return $this->all_scores[ $politician_id ];
		}
		
		// begin fetching scores
		$scores = $this->scores;
		
		// only for the given politician
		$scores->where( $scores->_belongs_to['politician']['foreign_key'], '=', $politician_id );
		
		// find the score
		$score = $scores->find();
		
		// put it into the internal database 
		$this->all_scores[ $politician_id ] = $score->score;
		
		return (int) $score->score;
	}
	
	/**
	 * This finds the person with the closest scores to this person
	 **/
	public function closest()
	{
		$id = $this->id;
		
		$query = DB::query(Database::SELECT, 'SELECT u2.id, SUM(s1.politician_id = s2.politician_id), SUM(ABS(s2.score - s1.score) + ABS(u2.self - u1.self) )
		FROM (people u1 JOIN scores s1 ON s1.person_id = u1.id)
			JOIN (people u2 JOIN scores s2 ON s2.person_id = u2.id)
			ON s1.politician_id  = s2.politician_id
			AND u1.id != u2.id
		WHERE u1.id = :user_id
		AND u2.fbc = 0
		GROUP BY u2.id
		ORDER BY (SUM(s1.politician_id = s2.politician_id) - ( SUM(ABS(s2.score - s1.score) + ABS(u2.self - u1.self) ) ) ) DESC
		LIMIT 1');
		
		$query->parameters(array(
		    ':user_id' => $id,
		));
				
		$result = $query->execute();
				
		return ORM::factory( 'person', $result->get('id') );
				
		// // start the query
		// 		$close = ORM::factory('person')
		// 		
		// 		// join to scores
		// 		>join('foodcats','INNER')
		// 		->on('foodcats.id','=',$foodcats_id)
		// 		->join('foodgroups','INNER')
		// 		->on('foodgroups.name','=',$foodgroups_name)
		// 		->find_all();
		// 		
		
	}
	
}

?>