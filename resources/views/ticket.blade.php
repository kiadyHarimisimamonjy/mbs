<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <!-- Google Font: Source Sans Pro -->

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body onload="printticket(); "  class="hold-transition sidebar-fixed">
  <div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div  class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="row mx-auto">
		<div class="col-12 fw-bold text-center fs-1 ">
                <h1><b>Cap St Marie </b></h1>
                <div class="col-12 text-center fs-6">
                    <h3><b>Tel : +261 34 00 000 00</b><h3>
                </div>
                <div class="col-12 text-center fs-6">
                    <h3><b>Facture N: {{$reservation->id}}</b><h3>
                </div>
              </div><!-- /.col -->
		</div>
      </section>

      <section class="content">
        <div class="container-fluid">

            <table class="table">

                <tbody>
                  <tr>
                    <td class=" h3 col-md-2"><b>Nom Client</b></td>
                    <td class=" h3 col-sm-1"><b>:</b></td>
                    <td class=" h4" >{{$reservation->customer}}</td>
                  </tr>
                  <tr>
                    <td class=" h3 col-md-2"><b>Nb. Place</b></td>
                    <td class=" h3 col-sm-1"><b>:</b></td>
                    <td class=" h4" >{{$placenb}}</td>
                  </tr>
                  <tr>
                    <td class=" h3 col-md-2"><b>Bateau</b></td>
                    <td class=" h3 col-sm-1"><b>:</b></td>
                    <td class=" h4" >{{$travel->boat->name}}</td>
                  </tr>
                  <tr>
                    <td class=" h3 col-md-2"><b>Itineraire</b></td>
                    <td class=" h3 col-sm-1"><b>:</b></td>
                    <td class=" h4" >{{$itinerary->name}}</td>
                  </tr>
                  <tr>
                    <td class=" h3 col-md-2"><b>Date Depart</b></td>
                    <td class=" h3 col-sm-1"><b>:</b></td>
                    <td class=" h4" >{{$travel->date}}</td>
                  </tr>
                  <tr>
                    <td class=" h3 col-md-2"><b>Heure Depart</b></td>
                    <td class=" h3 col-sm-1"><b>:</b></td>
                    <td class=" h4" >{{$travel->date}}</td>
                  </tr>
                  <tr>
                    <td class=" h3 col-md-2"><b>Net a payer</b></td>
                    <td class=" h3 col-sm-1"><b>:</b></td>
                    <td class=" h4" >{{$reservation->total}}</td>
                  </tr>
                  <tr>
                    <td class=" h3 col-md-2"><b>Reste a payer</b></td>
                    <td class=" h3 col-sm-1"><b>:</b></td>
                    <td class=" h4" >{{$unpaid}}</td>
                  </tr>


                </tbody>
              </table>
              <div class="  h2   text-center " ><b><i>
                Bon Voyage !!<i></b>
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
