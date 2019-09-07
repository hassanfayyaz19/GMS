<?php

require_once("./dompdf_config.inc.php");

  $dompdf = new DOMPDF();
  $dompdf->load_html("<table border='1'><tr><td>Hello World its me</td></tr></table>");
  $dompdf->set_paper("letter", "portrait");
  $dompdf->render();

  $dompdf->stream("dompdf_out.pdf");

  exit(0);


?>


