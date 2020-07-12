<?php
session_start();
date_default_timezone_set("Asia/Taipei");

class DB{
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db02";
    private $root="root";
    private $password="";
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->root,$this->password);
    }

    public function all(...$arg){
        $sql="SELECT * FROM $this->table ";
        if(!empty($arg[0]) && is_array($arg[0])){
            foreach ($arg[0] as $k=>$v) $tmp[]="`$k`='$v'";
            $sql.=" WHERE ".implode(" && ",$tmp);
        }
        $sql.=$arg[1]??'';
        return $this->pdo->query($sql)->fetchAll();
    }

    public function del($arg){
        $sql="DELETE FROM $this->table ";
        if(is_array($arg)){
            foreach($arg as $k=>$v) $tmp[]="`$k`='$v'";
            $sql.=" WHERE ".implode(" && ",$tmp);
        }else $sql.=" WHERE `id`='$arg'";
        return $this->pdo->exec($sql);
    }

    public function find($arg){
        $sql="SELECT * FROM $this->table ";
        if(is_array($arg)){
            foreach($arg as $k=>$v) $tmp[]="`$k`='$v'";
            $sql.=" WHERE ".implode(" && ",$tmp);
        }else $sql.=" WHERE `id`='$arg'";
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    
    public function count(...$arg){
        $sql="SELECT COUNT(*) FROM $this->table ";
        if(!empty($arg[0]) && is_array($arg[0])){
            foreach ($arg[0] as $k=>$v) $tmp[]="`$k`='$v'";
            $sql.=" WHERE ".implode(" && ",$tmp);
        }
        $sql.=$arg[1]??'';
        return $this->pdo->query($sql)->fetchColumn();
    }

    public function q($sql){
        return $this->pdo->query($sql)->fetchAll();
    }

    public function save($arg){
        if(isset($arg['id'])){
            foreach ($arg as $k=>$v) $tmp[]="`$k`='$v'";
            $sql=sprintf("UPDATE %s SET %s WHERE `id`='%s'",$this->table,implode(",",$tmp),$arg['id']);
        }else $sql=sprintf("INSERT INTO %s (`%s`) VALUES ('%s')",$this->table,implode("`,`",array_keys($arg)),implode("','",$arg));
        return $this->pdo->exec($sql);
    }
}

function to($url){
    header("location:$url");
}

$Log=new DB('log');
$News=new DB('news');
$Total=new DB('total');
$User=new DB('user');
$Que=new DB('que');


if(empty($_SESSION['total'])){
    $today=date("Y-m-d");
    $chk=$Total->count(['date'=>$today]);
    if($chk>0){
        $tt=$Total->find(['date'=>$today]);
        $tt['total']++;
        $_SESSION['total']=$tt['total'];
        $Total->save($tt);
    }else{
        $Total->save(['date'=>$today,'total'=>1]);
        $_SESSION['total']=1;
    }
}

?>
