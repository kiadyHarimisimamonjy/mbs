<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  @media print {
   html, body {
    width: 80mm;
    height:100%;
    position:absolute;
   }
}</style>
</head>

<body onload="printticket(); "  class="hold-transition sidebar-fixed">
  <div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div  class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="row mx-auto">
		<div class="col-12 fw-bold text-center fs-1 ">
               Cap St Marie
                <div class="col-12 text-center fs-6">
                    Tel : +261 34 00 000 00
                </div>
                <div class="col-12 text-center fs-6">
                    Facture N: {{$reservation->id}}
                </div>
              </div><!-- /.col -->
		</div>
      </section>

      <section class="content">
        <div class="container-fluid">

            <table class="table">

                <tbody>
                  <tr>
                    <td class="  col-md-2"><b>Nom Client</b></td>

                    <td  >{{$reservation->customer}}</td>
                  </tr>
                  <tr>
                    <td class="  col-md-2"><b>Nb. Place</b></td>

                    <td  >{{$placenb}}</td>
                  </tr>
                  <tr>
                    <td class="  col-md-2"><b>Bateau</b></td>

                    <td  >{{$travel->boat->name}}</td>
                  </tr>
                  <tr>
                    <td class="  col-md-2"><b>Itineraire</b></td>

                    <td  >{{$itinerary->name}}</td>
                  </tr>
                  <tr>
                    <td class="  col-md-2"><b>Date Depart</b></td>

                    <td  >{{$travel->date}}</td>
                  </tr>
                  <tr>
                    <td class="  col-md-2"><b>Heure Depart</b></td>

                    <td  >{{$travel->date}}</td>
                  </tr>
                  <tr>
                    <td class="  col-md-2"><b> total </b></td>

                    <td  >{{number_format($reservation->total, 0, ',', ' ')}} Ar</td>
                  </tr>
                  <tr>
                    <td class="  col-md-2"><b>Reste a payer</b></td>

                    <td  >{{number_format($unpaid, 0, ',', ' ')}} Ar</td>
                  </tr>


                </tbody>
              </table>
              <div class="h2 text-center" ><b><i>
                Bon Voyage !!</i></b>
              </div>
        </div><!-- /.container-fluid -->

      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- /.control-sidebar -->

  </div>
  <!-- ./wrapper -->
  <script>
    function printticket() {
        window.print();
        setTimeout(function () {
            window.location.href="/reservations/";
       }, 100);
    }
  </script>

</body>

</html>
