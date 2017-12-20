<?php
require_once("tcpdf/tcpdf.php");
require_once("FPDI/fpdi.php");

class JoinPdf{
	private $pdf;
	
	public function __construct($files, $newFileName = "merged-files-result.pdf", $destination = "I"){
		/*
		 parameter $destination:
		 "I" = send the file inline to the browser (DEFAULT)
		 "D" = force download
		 "F" = save to a local server file
		 "S" return the document as a string
		 "FI" = equivalent to F + I
		 "FD" = equivalent to F + D
		 "E" = return the document as base64 mime multi-part email attachment (RFC 2045)
		 */
		
		$this->pdf = new FPDI();
		$this->pdf->setPrintHeader(false);
		$this->pdf->setPrintFooter(false);
		
		$this->join($files);
		
		$this->pdf->Output($newFileName, $destination);
	}
	
	private function join($fileList){
		if(empty($fileList) || !is_array($fileList)){
			die("invalid file list");
		}
		
		foreach($fileList as $file){
			$this->addFile($file);
		}
	}
	
	private function addFile($file){
		$numPages = $this->pdf->setSourceFile($file);
		
		if(empty($numPages) || $numPages < 1){
			return;
		}
		
		for($x = 1; $x <= $numPages; $x++){
			$this->pdf->AddPage();
			$this->pdf->useTemplate($this->pdf->importPage($x), null, null, 0, 0, true);
			$this->pdf->endPage();
		}
	}
}