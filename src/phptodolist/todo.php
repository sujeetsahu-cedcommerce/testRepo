<?php
    session_start(); 
  
?>

<html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
    <a href="sessionempty.php">session destroy</a>
        <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            
            <p>
             <form action="servertodo.php" method="post">
                <input id="new-task" type="text" name="new-task">
                <input type="hidden" id='hidden-task' name='hiddenTask1'>
                <input type="hidden" id='hidden-task2' name='hiddenTask2'>
                <button id="addButton" name="add">Add</button>
                <button id="updateButton" hidden name="update">Update</button>
             </form>
            </p>

            <h3>Todo</h3>
            <div id="task">
            <ul id="incomplete-tasks">
             <?php if(isset($_SESSION['incomplete'])){
                    for($i=0;$i<count($_SESSION['incomplete']);$i++)
                    {
                        echo $_SESSION['incomplete'][$i];
                    }
                }
             ?>
            </ul>

            <h3>Completed</h3>
            <ul id="completed-tasks">
             <?php
             if(isset($_SESSION['completed'])){
                for($j=0;$j<count($_SESSION['completed']);$j++){
                    echo $_SESSION['completed'][$j];
                } 
            }
             ?>
            </ul>
            </div>
        </div>

    <script>
          $(document).ready(function(){
       
           $("#task").on("click",".edit",function(){
               var editTodoText=$(this).parent().children().eq(1).text();
               $("#new-task").val(editTodoText);
               var index = $(this).parent()[0].id;
               var a = $(this)[0].id;
               if(a=='incompletedEdit'){
                   $("#hidden-task2").val("incompletevalue");
               }
               else{
                   $("#hidden-task2").val("completevalue");
               }
               $("#addButton").css({"display":"inline"});
               $("#updateButton").css({"display":"inline"});
               $("#hidden-task").val(index);
               $("#addButton").hide();
           });

          $("#incomplete-tasks").on("click",".accept",function(){
            var id = $(this).parent()[0].id;
            let checked = document.querySelector('.accept:checked');
            if(checked){
             window.location.href="servertodo.php?chekedli="+id;
            }
          })

          $("#completed-tasks").on("click",".accept",function(){
            var id = $(this).parent()[0].id;
            let checked = document.querySelector('.accept:checked');
            if(checked){
                alert("unchecked");
             window.location.href="servertodo.php?unchekedli="+id;
            }
          })
        });
      
    </script>
    </body>
</html>