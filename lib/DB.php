<?php

class DB {

	public $DB;

	/***
     * Connect to DB
	 */
	public function __construct($host,$user,$password,$db){

		$dsn   = "mysql:host=".$host.";dbname=".$db.";charset=".CHARSET;  
 
		$options = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_EMULATE_PREPARES   => false,
		];

		try {
		  $this->DB = new PDO($dsn, $user, $password, $options);		  
		} catch (\PDOException $e) { echo $e->getMessage();
		  throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}

	}

	public function getRowById($table,$id)
    {
       $sql  = "SELECT * FROM $table WHERE id = :id ";
	   $stmt = $this->DB->prepare($sql);
	   $stmt->execute(['id'=>$id]);
	   $data = $stmt->fetch();
 
	   return $data;
    }

    public function getRow($table,$where)
    {	
       $keys = array_keys($where);	
       $sql  = "SELECT * FROM $table WHERE 1=1 ";
       foreach($where as $key=>$val){
       	 $sql.= " AND $key =:".$key;
       }

	   $stmt = $this->DB->prepare($sql);
	   $stmt->execute($where);
	   $data = $stmt->fetch();

	   return $data;	
    }

    public function getRows($table,$where)
    {	
       $keys = array_keys($where);	
       $sql  = "SELECT * FROM $table WHERE 1=1 ";
       foreach($where as $key=>$val){
       	 $sql.= " AND $key =:".$key;
       }

	   $stmt = $this->DB->prepare($sql);
	   $stmt->execute($where);
	   $data = $stmt->fetchAll();

	   return $data;	
    }

    public function getCount($table,$where,$exclude='')
    {
       $keys = array_keys($where);	
       $sql  = "SELECT count(*) as total FROM $table WHERE 1=1 ";
       foreach($where as $key=>$val){
       	 $sql.= " AND $key =:".$key;
       }

       if(!empty($exclude)){
       	 $sql.= " AND id <> :id";
       	 $where['id'] = $exclude;
       }

	   $stmt = $this->DB->prepare($sql);
	   $stmt->execute($where);
	   $data = $stmt->fetchColumn();

	   return $data;
    } 
	public function insert($table, $data)
{
    $keys = array_keys($data);
    $sql  = "INSERT INTO $table (" . implode(", ", $keys) . ") ";
    $sql .= " VALUES ( :" . implode(", :", $keys) . ")";

    try {
        $stmt = $this->DB->prepare($sql);
        $stmt->execute($data);

        // Check if insert was successful
        $id = $this->DB->lastInsertId();
        
        // Debugging
        if ($id > 0) {
          
            return $id;
        } else {
            echo "Insert failed. No ID returned.";
            return false;
        }
    } catch (PDOException $e) {
        echo "Insert failed: " . $e->getMessage();
        return false;
    }
}
public function lastInsertId() {
    return $this->DB->lastInsertId();
}

    public function update($table,$data,$id)
    {
    	if(empty($id)){
    		return false;
    	}

    	$keys   = array_keys($data);
		foreach($data as $key=>$val){
			$fields[]=" $key = :".$key;
		}

		$data['id'] = $id;
		$sql = "UPDATE $table SET ".implode(",",$fields);
		$sql.= " WHERE id =:id ";

		$stmt = $this->DB->prepare($sql);
		$stmt->execute($data);

		$id = $stmt->rowCount();
		if($id>=0){
		  return true;
		} else {
		  return false;
		}
    }

    public function delete($table,$id)
    {
    	if(empty($id)){
    		return false;
    	}

    	$sql  = "DELETE FROM $table WHERE id = :id";
		$stmt = $this->DB->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
		$stmt->execute();

		$id = $stmt->rowCount();
		if($id>=0){
		  return true;
		} else {
		  return false;
		}
    }
	public function getResults($table, $where)
{
    $sql = "SELECT * FROM $table WHERE 1=1";
    foreach ($where as $key => $val) {
        $sql .= " AND $key = :$key";
    }

    $stmt = $this->DB->prepare($sql);
    $stmt->execute($where);
    return $stmt->fetchAll();
}
public function getRowsByField($table, $field, $value) {
    $query = "SELECT * FROM $table WHERE $field = :value";
    $stmt = $this->DB->prepare($query); // Use $this->DB if that's your connection object
    $stmt->bindParam(':value', $value);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
