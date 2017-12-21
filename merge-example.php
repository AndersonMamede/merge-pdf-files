<?php
require_once("MergePdf.class.php");

MergePdf::merge(
	Array(
		"test/file-a.pdf",
		"test/file-b.pdf",
		"test/file-c.pdf",
		"test/file-d.pdf",
		"test/file-e.pdf"
	),
	MergePdf::DESTINATION__DISK_INLINE
);