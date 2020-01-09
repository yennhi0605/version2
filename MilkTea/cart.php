<?php
require "database.php";

    $sql = "SELECT * from milkteas";
    $result = $db->query($sql)->fetch_all() ;

    // $sql1 = "SELECT * from cart";
    // $result1 = $db->query($sql1)->fetch_all() ;
    
//delete//    

    if(isset($_POST["id_cart"])){
        $id = $_POST["id_cart"];
        $sql1 = "DELETE from cart where id= ".$id;
        $db->query($sql1);
        }
  
//update//
    if(isset($_POST["down"])){
        $id_down = $_POST["down"];
        $id=$result1[$id_down][0];
        $result1[$id_down][5]-=1;
        $sl = $result1[$id_down][5];
        $price=$result1[$id_down][4];
        $total =$price*$sl;
        $result1[$id_down][6]=$total;
        $sql1 = "UPDATE cart SET quantity= $sl, total=$total where id = ".$id;
        $db->query($sql1);
        
        if($result1[$id_down][5]==0){
        $sql1 = "DELETE from cart where id = ".$id;
        $db->query($sql1);
        }
        
        }
    
        if(isset($_POST["up"])){
        $id_up = $_POST["up"];
        $id = $result1[$id_up][0];
        $result1[$id_up][5]+=1;
        $sl = $result1[$id_up][5];
        $price=$result1[$id_up][4];
        $total =$price*$sl;
        $result1[$id_up][6]=$total;
        $sql1 = "UPDATE cart SET quantity= $sl, total=$total where id = ".$id;
        $db->query($sql1);
            }

//function//            

    function sum($result1){
        $sum=0;
        for($i = 0; $i < count($result1); $i++) {
            $sum+=$result1[$i][6];
        }
        return $sum;
    }
    
//=================//
if(isset($_POST["order"])){
    
}

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form action="" method="post">
        <p style="color: black; font-weight: bold;text-align:center; font-size: 20px; margin-top: 50px;">MY SHOPPING CART</p>  
        <div class="line">
        <table>
        <tr>
            <th>ID</th>
            <th>Img</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Del</th>
        </tr>
    

        <?php 
            for($i = 0; $i < count($result1); $i++) { 
        ?>
         <tr>
            <td><?php echo $result1[$i][0]; ?></td>
            <td><img  src="<?php echo $result1[$i][2] ?>" style="width:20px ; height: 20px" alt="Image"></td>
            <td><?php echo $result1[$i][3]; ?></td>
            <td><?php echo $result1[$i][4]; ?></td>
            <td><button name="down" value="<?php echo $i;?>" style="width: 10px; height: 10px;"></button><?php echo $result1[$i][5]; ?><button name="up" value="<?php echo $i;?>" style="width: 10px; height: 10px;"></button></th>
            <td><?php echo $result1[$i][6]; ?></td>
            <td><button class="delete" name="id_cart" value="<?php echo $result1[$i][0];?>">Delete</button></td>
        </tr>
    
    <?php } ?>
    </table>
</body>
</html>
  