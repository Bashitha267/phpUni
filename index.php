<?php
$array=[
    ["name"=>"Nimesh","Age"=>25],
    ["name"=>"Bashitha","Age"=>25],
    ["name"=>"Kamal","Age"=>75],

];
// echo"$array[b]";
$fruits=[
    "Apple","Banana","Cherry"
];

?>
<html>
    <head>
        
    <title>this is my first</title>
    <link rel="stylesheet" href="./mycss.css">  
</head>
<body>
<div >
    <!-- <ul>
    <?php 
    foreach($array as $key=>$value){
        echo"<li class=\"name\">Name:{$value['name']}, Age:{$value['Age']}
        </li>";
    }

?>
    </ul> -->
<?php
$array12=array_unshift($fruits,1);

print_r($fruits);
?>

</div>  
</body>
  
</html>