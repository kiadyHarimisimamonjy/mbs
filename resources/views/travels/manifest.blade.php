<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Manifeste Navire</title>
<style>
    /* Add some padding on document's body to prevent the content
    to go underneath the header and footer */
    table {

  width: 100%;
  font-size: 13px;
}

th, td {
  padding: 8px;
    line-height:3px ;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

    .body{
   padding-left: 15px;
        margin-top: 70px;
    }
    .fixed-header, .fixed-footer{
        padding-top:3px;
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
     .title{
       text-align: center;
        width: 100%;
        font-weight: bold;
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
         <div class="title">Liste des passagers</div>
              <div class="left">
              Navire: {{$travel->boat->name}}<br>
                    Port de Depart: {{$travel->itinerary->leaving}}
              </div>
               <div class="right">
               Date: {{$travel->date}}<br>
                    Port de Destination:  {{$travel->itinerary->arrival}}
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
    @foreach ( $customers as $customer)
 <tr>
                     <td>{{ $loop->iteration }}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->cin}}</td>
                    <td>{{$customer->age}}</td>
                    <td>{{$customer->sexe}}</td>
                    <td>{{$customer->reservation->contact}}</td>
                </tr>

            @endforeach

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
