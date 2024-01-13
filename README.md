# Merge PDF files

This project is a simple example on how to merge PDF files together using `tcpdf` and `FPDI` libraries.

### Installation

Option 1 - Clone this repository:

```sh
git clone https://github.com/AndersonMamede/merge-pdf-files.git
```

Option 2 - or download the zip file:
[https://github.com/AndersonMamede/merge-pdf-files/archive/master.zip](https://github.com/AndersonMamede/merge-pdf-files/archive/master.zip)

### Example

```php
<?php
require_once("MergePdf.class.php");

MergePdf::merge(
    [
        "test/file-a.pdf",
        "test/file-b.pdf",
        "test/file-c.pdf",
        "test/file-d.pdf",
        "test/file-e.pdf"
    ],
    MergePdf::DESTINATION__DISK_INLINE
);
```
