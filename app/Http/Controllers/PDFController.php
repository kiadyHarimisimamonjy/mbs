<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;



class PDFController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function generatePDF()

    {

        $data = [

            'title' => 'Welcome to ItSolutionStuff.com',

            'date' => date('m/d/Y')

        ];



        $pdf = PDF::loadView('ticket', $data);



        return $pdf->download('itsolutionstuff.pdf');

    }
    public function index()
    {
        return view('ticket');
    }

}
