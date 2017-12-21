<?php
require_once("tcpdf/tcpdf.php");
require_once("fpdi/fpdi.php");

class MergePdf{
	const DESTINATION__INLINE = "I";
	const DESTINATION__DOWNLOAD = "D";
	const DESTINATION__DISK = "F";
	const DESTINATION__DISK_INLINE = "FI";
	const DESTINATION__DISK_DOWNLOAD = "FD";
	const DESTINATION__BASE64_RFC2045 = "E";
	
	const DEFAULT_DESTINATION = self::DESTINATION__INLINE;
	const DEFAULT_MERGED_FILE_NAME = __DIR__ . "/merged-files.pdf";
	
	public static function merge($files, $destination = null, $outputPath = null){
		if(empty($destination)){
			$destination = self::DEFAULT_DESTINATION;
		}
		
		if(empty($outputPath)){
			$outputPath = self::DEFAULT_MERGED_FILE_NAME;
		}
		
		$pdf = new FPDI();
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		self::join($pdf, $files);
		$pdf->Output($outputPath, $destination);
	}
	
	private static function join($pdf, $fileList){
		if(empty($fileList) || !is_array($fileList)){
			die("invalid file list");
		}
		
		foreach($fileList as $file){
			self::addFile($pdf, $file);
		}
	}
	
	private static function addFile($pdf, $file){
		$numPages = $pdf->setSourceFile($file);
		
		if(empty($numPages) || $numPages < 1){
			return;
		}
		
		for($x = 1; $x <= $numPages; $x++){
			$pdf->AddPage();
			$pdf->useTemplate($pdf->importPage($x), null, null, 0, 0, true);
			$pdf->endPage();
		}
	}
}