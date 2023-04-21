<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

class indexController extends Controller
{
    //

        public function index()
    {
        //echo "<img src='img/empty.png' class='card-img-top' alt='...'>";
        return view('index.index');
    }

        public function dompdf()
    {

        //get the data or database 
        $data = [        ['id' => 1, 'name' => 'John', 'email' => 'john@example.com'],
        ['id' => 2, 'name' => 'Jane', 'email' => 'jane@example.com'],
        ['id' => 3, 'name' => 'Bob', 'email' => 'bob@example.com'],
        ];

        $html = view('index.dompdf', ['data' => $data,'name'=> 'jack'])->render();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->setBasePath(public_path());
        //set extenal file to load, the file or link will be in html
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        

        $dompdf->loadHtml($html);


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('test.pdf', array('Attachment' => false));

    }
}
