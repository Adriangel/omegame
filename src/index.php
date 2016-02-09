<!-- TEST Script-->
<pre><?php
include("./traits/ModelHelper.php");

class A{
	use ModelHelper;
	
	const dbtable = "Atable";
	
	private $id;
	private $col1;
	
	public function __construct(){
		$this->id = 1;
		$this->col1 = rand(1,10);
	}
	
	public function f(){
		return $this->generateUpdateQuery(array("col1"));
	}
}

$o = new A();
echo $o->f();
?></pre>