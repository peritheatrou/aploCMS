<?php




include "include/start.php";
include "config.php";


$cat=loaddata('cat');


if(isset($_POST['Update'])=='Update'){
 $cat_old=loaddata('cat');
  
   
   for($q=1;$q<=$make_cat;$q++){
 
       $cat[$q]['name']=trim(@$_POST['name'.$q]);
       $cat[$q]['active']=trim(@$_POST['active'.$q]);
       $cat[$q]['seira']=trim(@$_POST['seira'.$q]);
       
        
   }
 
     // make new name folder
     //disable this for now
      for($q=1;$q<=$make_cat;$q++){
        
         $old_dir_name=neo_name($cat_old[$q]['name']);
           
         $dir_name=neo_name($cat[$q]['name']);
  
         
              
                rename ('../image/'.$old_dir_name,'../image/'.$dir_name);
                
            
    }
  


 // bale me  seira
foreach ( $cat as $key => $row ) { 
   $name [ $key ] = $row [ 'name' ]; 
   $active [ $key ] = $row [ 'active' ]; 
   $seira [$key]= $row [ 'seira' ];
} 

   array_multisort (  $active , SORT_ASC , $seira , SORT_ASC , $cat ); 
   savedata($cat,'cat');

}


 function showcat(){
  global $cat,$q; 
     
    if($cat[$q]['active']=="active"){ $active="selected";$stop="";$class="active";}else{$active="";$stop="selected";$class="stop";}
    
    echo '<tr><td align="right" valign="top">
          <th><select id="s'.$q.'" name="active'.$q.'" class="'.$class.'" >
          <option value="active" '.$active.'>Active</option>
          <option value="stop" '.$stop.'>STOP</option>
          </select></th> 
          <th><input id="u'.$q.'" type="text"  name="name'.$q.'"  value="'.$cat[$q]['name'].'"  required></th> 
          <th><input id="p'.$q.'" type="number"  name="seira'.$q.'"  value="'.$cat[$q]['seira'].'" size="5" required></th> 
           
          </td></tr>';
  $disable='';
  }
 include "include/header.php";
?>

        <form id="form" action="cat.php" method="post" >
        <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
        <tr><td><h1>Category</h1></td></tr>
        <tr><td><th>Active</th><th>Category Name</th>  <th>Sequense</th> </td></tr>
        <?php

            for ($q=0;$q<=$make_cat;$q=$q+1){
              if($cat[$q]['name']!='') showcat(); 
            }

        ?>
        <tr><td><th>
        
        </th><th colspan="4"><input id="update" type="submit" name="Update" value="Update" ></th>
          </td></tr>
         
        </table>
        </form>
<?php

include 'include/footer.php';
?>
