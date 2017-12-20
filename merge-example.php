<?php
require_once("JoinPdf.class.php");

$mergedFileDestination = __DIR__."/merged-files.pdf";

new JoinPdf(Array(
	"test/file-a.pdf",
	"test/file-b.pdf",
	"test/file-c.pdf",
	"test/file-d.pdf",
	"test/file-e.pdf"
), $mergedFileDestination, "FI");