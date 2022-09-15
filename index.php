<?php

$conn=mysqli_connect('localhost','root','','test5');
// if($conn){
//     echo "we are connected to database";
// }

//a) Prikažite sve kororisnike koji su se prijavili u prethodna dva dana
$sql="SELECT * from user WHERE DATE_SUB(CURDATE(),INTERVAL 1 DAY) <= dateCreate;";
$res=mysqli_query($conn, $sql);

echo "<h2>All users added in last 2 days </h2>";

while($row=mysqli_fetch_assoc($res)){
    $id=$row['id'];
    $name=$row['firstname'];
    $lastname=$row['lastname'];
    $phone=$row['phone'];
    $email=$row['email'];
    $dateCreate=$row['dateCreate'];

    echo "<div>ID: {$id} | name: {$name} | lastname: {$lastname} | phone: {$phone} | email: {$email} | created on date: {$dateCreate}</div>"   ;
}


//b) Prikažite ime I prezime korisnika, id porudžbine I ukupnu vrednost svih porudžbinama
echo "<br>";
echo "<h2>User with order and sum of order value</h2>";

$sql2="SELECT user.firstname, user.lastname, order.id, SUM(orderitem.value) FROM `user` INNER JOIN `order`INNER JOIN orderitem  ON user.id = order.User_id AND orderitem.Order_id = order.id GROUP BY  user.id, order.id";

$res2=mysqli_query($conn, $sql2);

while($row=mysqli_fetch_assoc($res2)){
    $name=$row['firstname'];
    $lastname=$row['lastname'];
    $orderId=$row['id'];
    $value=$row['SUM(orderitem.value)'];

    echo "<div>name: {$name} | lastname: {$lastname} | orderId: {$orderId} | value: {$value}</div>"   ;
}


//c) Prikažite sve korisnike koji su imali najmanje dve porudžbine
echo "<br>";
echo "<h2>User with at least 2 orders</h2>";

$sql3="SELECT * , order.id, MAX(user.firstname) FROM `user` INNER JOIN `order` ON user.id = order.User_id  GROUP BY  user.id HAVING COUNT(*)>1";

$res3=mysqli_query($conn, $sql3);

while($row=mysqli_fetch_assoc($res3)){
    $name=$row['firstname'];
    $lastname=$row['lastname'];
    $orderId=$row['id'];
    echo "<div>name: {$name} | lastname: {$lastname} </div>"   ;
}


//d) Prikažite ime I prezime korisnika, id porudžbine I broj stavki za svaku porudžbinu
echo "<br>";
echo "<h2>User with order id and number of items for same order</h2>";

$sql4="SELECT user.firstname, user.lastname, `order`.id, COUNT(orderItem.id) AS itemNumber FROM `user` INNER JOIN `order` INNER JOIN orderitem  ON user.id = `order`.User_id AND orderitem.Order_id = `order`.id GROUP BY  user.id, `order`.id";

$res4=mysqli_query($conn, $sql4);

while($row=mysqli_fetch_assoc($res4)){
    $name=$row['firstname'];
    $lastname=$row['lastname'];
    $orderId=$row['id'];
    $itemNUmber=$row['itemNumber'];
    echo "<div>name: {$name} | lastname: {$lastname} | orderId: {$orderId} | Number of item: {$itemNUmber} </div>"   ;
}


//e) Prikažite ime I prezime korisnika, id porudžbine koja ima najmanje dve stavke


//f) Prikažite sve korisnike koji su kupili najmanje tri različita proizvoda u svim porudžbinama      



?>