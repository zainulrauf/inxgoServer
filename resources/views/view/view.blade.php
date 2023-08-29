<head>
    <meta charset="UTF-8">
    <meta name="description" content="Add a loading spinner to Datatables without AJAX" />
    <title>Bootstrap 4 Responsive Datatable with Loading Spinner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <style type="text/css">
        #loadercontainer{
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
 <div class="container">
  <div class="row">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Date</th>
            <th>Priority</th>
            <th>Query</th>
          </tr>
        </thead>
        <tbody>
        @foreach($data as $key =>$value)
          @foreach($value as $key_1 =>$value_1)
          @php
            $new = preg_split('/\t+/', $value_1);
            $html='';
            foreach($new as $key1=> $newvalue)
            {
              if(isset($new[1]) && $key1 == 1 && !str_contains($newvalue, 'Connect'))
              {
                $newvalue=' ';
              } 
              $html=$html.'<td>'.$newvalue.'</td>'; 
              if(count($new) == 1 && array_key_last($new) ==$key1 )
              {
                $html=$html.'<td>  </td>';  
              }
              if(count($new) < 3 && array_key_last($new) ==$key1 )
              {
                $html=$html.'<td>  </td>'; 
              }
            }
          @endphp
          <tr>
            {!!$html!!}
          </tr>
          @endforeach()
        @endforeach()
        </tbody>
    </table>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
 <script type="text/javascript">
    $(document).ready(function() {    
      $('#example').DataTable( {
      });
    });
 </script>
</body>
</html>