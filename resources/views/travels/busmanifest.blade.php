<html>
    <head>
        <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
              table {

  width: 100%;
  font-size: 13px;
}

th, td {
  padding: 8px;
    line-height:5px ;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
                .left{
 padding-left: 20px;
       float: left;
        width: 34%;
    }
     .center{
       display: inline-block;
       text-align: center;
       font-size: 21px;
    margin:0 auto;
    width:25%;
        font-weight: bold;
    }
     .right{
       float: right;
        width: 35%;
    }
            @page {
                margin: 0cm 0cm;
            }
            .page-break {
                page-break-after: always;
            }
            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 4cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                padding-top: 10px;
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;


            }
            footer >table{
                width:100%;
                border-bottom:  0px solid #ffff;;
           }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
          <div class="left">
                    TAMATAVE E0005200039<br>
                     STAT: 348 42 NIF: 3989501<br>
                    Tanambao V Bd.Andevoranto<br>
                    STAT
              </div>
                 <div class="center">
                FICHE BUS<br>
                   SMS-TMM
              </div>
               <div class="right">
                Chauffeur:<br>
                   N Vehicule:<br>
                     Tel:<br>
                       Heure Depart:<br>
                         Heure Arrive:<br>
                          Date Retour:<br>
              </div>
        </header>

        <footer>
                <table >
                <tr>
                      <th>NOMBRE PAX</th>
                    <th> BUREAU TMM</th>
                    <th>Le Responsable</th>
                    <th>Chauffeur</th>

                </tr>
                </table>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
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
                     @if($loop->iteration == 19 || $loop->iteration == 37)
      </table>
                <div class="page-break"></div>
                 <table>
                <tr>
                      <th>N</th>
                    <th> Nom et prenom</th>
                    <th>CIN</th>
                    <th>Age</th>
                     <th>Sexe</th>
                     <th>Contact</th>
                </tr>



	        @endif
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

        </main>
    </body>
</html>
