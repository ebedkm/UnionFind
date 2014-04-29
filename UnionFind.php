<?php
	/*
		Union Find Disjoint
	*/

	class UnionFind{
		private $p; //parent
		private $rank; 
		private $setSize; 
		private $numSets;
		function __construct($N){
			
			$this->p  = array();
			$this->rank  = array();
			$this->setSize  = array();
			for($i=0; $i<$N; $i++){$this->setSize[$i] = 1;} // setSize.assign(1)
			for($i=0; $i<$N; $i++){$this->rank[$i] = 0;} // rank.assign(0)
			for($i=0; $i<$N; $i++){$this->p[$i] = $i;} // p.assign(0)
			$this->numSets = $N;
		}

		function findSet( $i ){
			if( $this->p[ $i ] == $i )  
				return $i;
			return ( $this->p[ $i ] = $this->findSet( $this->p[ $i ] ));
		}
		function isSameSet($i, $j) { return $this->findSet($i) == $this->findSet($j); }
		function unionSet($i, $j) {
		    if ($this->isSameSet($i, $j) == false) { 
		    	$this->numSets--;
		    	//echo "numset: $this->numSets";
		    	$x = $this->findSet($i);
		    	$y = $this->findSet($j);
		    	// rank is used to keep the tree short
		    	if ($this->rank[$x] > $this->rank[$y]) { $this->p[$y] = $x; $this->setSize[$x] += $this->setSize[$y]; }
		    	else                   { $this->p[$x] = $y; $this->setSize[$y] += $this->setSize[$x];
		                             	if ($this->rank[$x] == $this->rank[$y]) $this->rank[$y]++; } 
		    } 
		}
	  	function numDisjointSets() { return $this->numSets; }
	  	function sizeOfSet($i) { return $this->setSize[ $this->findSet($i) ]; }
	}

	/*
	$UF = new UnionFind(10);
	$UF->unionSet(1, 2);
	$UF->unionSet(1, 3);
	$UF->unionSet(2, 5);
	echo $UF->numDisjointSets();
	*/
?>