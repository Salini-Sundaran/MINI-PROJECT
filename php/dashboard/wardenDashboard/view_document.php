<?php
session_start();

// Include your database connection
include "../../../connection/connection.php";

// Check if a document ID is provided in the URL
if (isset($_GET['id'])) {
    $documentId = $_GET['id'];

    // Fetch the document details from the database
    $query = "SELECT * FROM files WHERE id = $documentId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $document = $result->fetch_assoc();
        $documentPath = $document['file_path'];
    } else {
        // Redirect back to the document list if the document is not found
        header("Location: verifications.php");
        exit();
    }
} else {
    // Redirect back to the document list if no document ID is provided
    header("Location: verifications.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Document</title>
</head>

<body>

    <!-- Display the document content using PDF.js -->
    <div id="pdf-container"></div>

    <script>
        // Load PDF document using PDF.js
        var pdfPath = "<?php echo $documentPath; ?>";
        var pdfContainer = document.getElementById("pdf-container");

        // PDF.js configuration
        var pdfjsLib = window['pdfjs-dist/build/pdf'];

        pdfjsLib.getDocument(pdfPath).promise.then(function (pdfDoc) {
            for (var pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
                pdfDoc.getPage(pageNum).then(function (page) {
                    var canvas = document.createElement("canvas");
                    var context = canvas.getContext("2d");
                    pdfContainer.appendChild(canvas);

                    // Scale the canvas for better rendering
                    var viewport = page.getViewport({ scale: 1.5 });
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    // Render PDF page into canvas context
                    page.render({ canvasContext: context, viewport: viewport });
                });
            }
        });
    </script>

</body>

</html>
