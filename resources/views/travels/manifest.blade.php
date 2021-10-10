<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Implement Sticky Header and Footer with CSS</title>
<style>
    /* Add some padding on document's body to prevent the content
    to go underneath the header and footer */
    table {

  width: 90%;
  font-size: 13px;
}

th, td {
  padding: 8px;
    line-height:3px ;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

    .body{
   padding-left: 20px;
        margin-top: 50px;
    }
    .fixed-header, .fixed-footer{
        width: 100%;
        position: fixed;

    }
     .left{
 padding-left: 20px;
       float: left;
        width: 45%;
    }
     .right{
       float: right;
        width: 50%;
    }
    .fixed-header{
        top: 0;
    }
    .fixed-footer{
        bottom: 35px;
    }


</style>
</head>
<body>
    <div class="fixed-header">
              <div class="left">
                    Navire: Cap Sainte Marie<br>
                    Port de Depart: Sonerana
              </div>
               <div class="right">
                Date: Cap Sainte Marie<br>
                    Port de Destination: Sonerana
              </div>
    </div>
    <div class="body">
        <table>
                <tr>
                      <th>N</th>
                    <th> Nom et prenom</th>
                    <th>CIN</th>
                    <th>Age</th>
                     <th>Sexe</th>
                     <th>Contact</th>
                </tr>
              <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
                 <tr>
                     <td>12</td>
                    <td>Peter rerere</td>
                    <td>321 321 2312 321</td>
                    <td>40</td>
                     <td>Homme</td>
                    <td>032 32 320 32</td>
                </tr>
        </table>
    </div>
    <div class="fixed-footer">
        <div class="left">
                 APMF
              </div>
               <div class="right">
               Capitain
              </div>
    </div>
</body>
</html>
