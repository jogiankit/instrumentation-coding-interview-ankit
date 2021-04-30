<?php

/*
Global counter testcases
*/

echo "\n\n**************************************\n";
echo "Testcases for counter function\n";
echo "**************************************\n";

/*
Get first instance without increment,
API should return with ZERO instead of garbage value
*/
function testCounterFunctionsTcType0() {
	if (0 == SolarwindsGetTotal()) {
		echo "Testcase-0: PASS\n";
	} else {
		echo "Testcase-0: FAIL\n";
	}
}

/*
Run single-threaded APIs to check for
max limit of the the counter
*/
function testCounterFunctionsTcType1($tc_no, $limit) {
	SolarwindsReset();
	for($i = 0; $i < $limit; $i++) {
    	SolarwindsIncrement();
	}
	if ($limit == SolarwindsGetTotal()) {
		echo "Testcase-".$tc_no.": PASS\n";
	} else {
		echo "Testcase-".$tc_no.": FAIL\n";
	}
}

/*
Run multithreaded APIs to check if
counter update is synchronized
*/
function testCounterFunctionsTcType2($tc_no, $th_no) {
	$arr = array();

	SolarwindsReset();

	$p1 = function(int $worker) {
	    for($i = 0; $i < 1000; $i++) {
	        sleep(0.1);
	        SolarwindsIncrement(); // TODO implement
	    }
	};

	for($i = 0; $i < $th_no; $i++) {
    	$r = new \parallel\Runtime();
    	$arr[$i] = $r->run($p1, array($i+1));
	}
	for($i = 0; $i < $th_no; $i++) {
    	$arr[$i]->value();
	}

	if (($th_no * 1000) == SolarwindsGetTotal()) {
		echo "Testcase-".$tc_no.": PASS\n";
	} else {
		echo "Testcase-".$tc_no.": FAIL\n";
	}
}

/*
Run two threads, one which only increments the counter
and another does reset based on some condition.
Verify the final count to ensure synchronzation of counter
*/
function testCounterFunctionsTcType3($tc_no) {
	$arr = array();

	SolarwindsReset();

	$p2 = function(int $worker) {
	    for($i = 0; $i < 1000; $i++) {
	        sleep(0.1);
	        SolarwindsIncrement(); // TODO implement
	    }
	};

	$p1 = function(int $worker) {
		while (1) {
			if (550 == SolarwindsGetTotal()) {
	    		SolarwindsReset();
	    		break;
	    	}
		}
	};

	$r1 = new \parallel\Runtime();
	$arr[0] = $r1->run($p1, array(0+1));

	$r2 = new \parallel\Runtime();
	$arr[1] = $r2->run($p2, array(1+1));

	$arr[0]->value();
	$arr[1]->value();

	if ((1000-550) == SolarwindsGetTotal()) {
		echo "Testcase-".$tc_no.": PASS\n";
	} else {
		echo "Testcase-".$tc_no.": FAIL\n";
	}
}

/*
Take memory snapshot before and after executing
all/individdual APIs, and find the difference to find leak
**TODO** - It currently doesn't detect memory from extensions
*/
function testCounterFunctionsMemoryLeak() {
	echo "memory before: ".(memory_get_usage())."\n";
	SolarwindsReset();
	SolarwindsIncrement();
	SolarwindsGetTotal();
	echo "memory after: ".(memory_get_usage())."\n";
}

/* Execute test-cases
*/
testCounterFunctionsTcType0();
testCounterFunctionsTcType1(1, 10000);
testCounterFunctionsTcType1(2, 100000);
testCounterFunctionsTcType1(3, 1000000);
testCounterFunctionsTcType1(4, 10000000);
testCounterFunctionsTcType1(5, 100000000);

testCounterFunctionsTcType2(6, 10);
testCounterFunctionsTcType2(7, 100);
testCounterFunctionsTcType2(8, 1000);

testCounterFunctionsTcType3(9);

testCounterFunctionsMemoryLeak();

echo "\n*******************************************\n\n";

?>
