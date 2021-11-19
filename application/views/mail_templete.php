<body>
      
      <table width = "100%" height = "100%" border = "0" 
         cellpadding = "0" cellspacing = "0">
         <tr>
            <td align = "center">
               <form name = "filepost" method = "post" 
                  action = "file.php" enctype = "multipart/form-data" id = "file">
                  
                  <table width = "300" border = "0" cellspacing = "0" 
                     cellpadding = "0">

                     <tr valign = "bottom">
                        <td height = "20">Thanks for Register With Medinfinite2.o</td>
                     </tr>
							
                     <tr valign = "bottom">
                        <td height = "20">Name:</td>
                     </tr>
                     
                     <tr>
                        <td><?php echo $user_data['name']?></td>
                     </tr>
                     
                     <tr valign = "bottom">
                        <td height = "20">Your Event:</td>
                     </tr>
                     
                     <tr>
                        <td class = "frmtxt2"><?php echo $user_data['event']?></td>
                     </tr>
                     
                     <tr>
                        <td height = "20" valign = "bottom">Attach File:</td>
                     </tr>
                     
                     <tr valign = "bottom">
                        <td valign = "bottom"><?php echo "https://chat.whatsapp.com/FijXpVNqsgPHUJ9ricdFoj"; ?></td>
                     </tr>
                     
                     <tr>
                        <td height = "40" valign = "middle">Thanking You .. Medinfinite2.o
                       </td>
                     </tr>
                  </table>
                  
               </form>
               
               <center>
                  <table width = "400">
                     
                     <tr>
                        <td id = "one">
                        </td>
                     </tr>
                     
                  </table>
               </center>
               
            </td>
         </tr>
      </table>
      
   </body>