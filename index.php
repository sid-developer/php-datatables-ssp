<?php

// $conn = new mysqli("localhost:3308", "root", "root", "test");

// if(!$conn->connect_errno)
//    {
//       $stmt = $conn->prepare('"SELECT * FROM track_list Group By track_id"');
//       $stmt->execute();
//       $stmt->store_result();
//       echo "Total Number of Rows = ", $stmt->num_rows;
//    }
//    $conn->close();

// die;
?>

<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Start date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Start date</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>

    $(document).ready(function () {
        // $('#example').DataTable({
            
        // });

        DataTable.datetime('YYYY-MMM-D');

        // Setup - add a text input to each footer cell
    $('#example tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });
 
    // DataTable
    var table = $('#example').DataTable({
        processing: true,
            serverSide: true,
            ajax : {
                url :'get-data-ssp.php',
                data: function (d) {
                d.myKey = 'myValue';
                // d.custom = $('#myInput').val();
                // etc
                },
            },
            
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
        columnDefs: [
            {
                targets: 4,
                render: DataTable.render.datetime('Do MMM YYYY'),
            },
        ],
    });

    });

</script>