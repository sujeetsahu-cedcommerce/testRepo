<?php
// Server Page of TODO
session_start();

if(!isset($_SESSION['todo'])){
    $_SESSION['todo']=array();
}

if(!isset($_SESSION['incomplete'])){
    $_SESSION['incomplete']=array();
}

if(!isset($_SESSION['todocompleted'])){
    $_SESSION['todocompleted']=array();
}

if(!isset($_SESSION['completed'])){
    $_SESSION['completed']=array();
}


function display(){
    for($i=0;$i<count($_SESSION['todo']);$i++)
    {
        $row = '<li id='.$i.'><input type="checkbox" class="accept"><label>'.$_SESSION['todo'][$i].'</label><input type="text"><button id= "incompletedEdit"class="edit">Edit</button><button class="delete"><a href="servertodo.php?deleteindex='.$i.'">Delete</a></button></li>';
        $_SESSION['incomplete'][$i]=$row;
    }
}
    
if(isset($_POST['add'])){
    $task = $_POST['new-task'];
    if($_POST['new-task']!=""){
    $_SESSION['todo'][]=$task;
    display();
   }
}



if(isset($_GET['deleteindex'])){
    $i=$_GET['deleteindex'];
    array_splice($_SESSION['todo'],$i,1);
    array_splice($_SESSION['incomplete'],0);
    display();
}

if(isset($_GET['chekedli'])){
    $id=$_GET['chekedli'];
    $_SESSION['todocompleted'][]=$_SESSION['todo'][$id];
    array_splice($_SESSION['todo'],$id,1);
    array_splice($_SESSION['incomplete'],0);
    display();
}

function displayCompleted(){
    for($j=0;$j<count($_SESSION['todocompleted']);$j++){
    $row1='<li id='.$j.'><input class="accept" type="checkbox" checked><label>'.$_SESSION['todocompleted'][$j].'</label><button id="completedEdit" class="edit">Edit</button><button class="delete"><a href="servertodo.php?deleteCompletedTask='.$j.'">Delete</a></button></li>'; 
    $_SESSION['completed'][$j]=$row1;
}
}

if(isset($_SESSION['todocompleted'])){
    displayCompleted();
}

if(isset($_POST['update'])){
    if(isset($_POST['hiddenTask2'])){
        $value = $_POST['hiddenTask2'];
        if($value=='completevalue'){
            $index = $_POST['hiddenTask1'];
            $_SESSION['todocompleted'][$index]=$_POST['new-task'];
            displayCompleted();
            
        }
        else{
            $index = $_POST['hiddenTask1'];
            $_SESSION['todo'][$index]=$_POST['new-task'];
            display();
        }
    }
}

if(isset($_GET['deleteCompletedTask'])){
    $j=$_GET['deleteCompletedTask'];
    array_splice($_SESSION['todocompleted'],$j,1);
    array_splice($_SESSION['completed'],0);
    displayCompleted();
}

if(isset($_GET['unchekedli'])){
    $j=$_GET['unchekedli'];
    $_SESSION['todo'][]=$_SESSION['todocompleted'][$j];
    array_splice($_SESSION['todocompleted'],$j,1);
    array_splice($_SESSION['completed'],0);
    display();
    displayCompleted();
}

header('location: ./todo.php');
?>





