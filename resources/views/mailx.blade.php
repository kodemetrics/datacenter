<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
  <style type="text/css">
   @import url('https://fonts.googleapis.com/css?family=Poppins|Roboto');
 body{
    font-family: Courier, sans-serif;
    table-layout: fixed;
    width: 100%;
    background-color: #eee;
    font-weight:bold;
 }

 h3{
   font-family: 'Roboto', sans-serif;
 }

 p{
    font-family: 'Poppins', sans-serif;
    color:#777;
    font-size:14px;
 }

.content{
    width: 100%;
    background-color: #eee;
}

.width{
    margin:2% 20%;
    border-radius:2px;
    background-color:#FFF;
    border-top: 1rem solid #000375;
    padding:10px 20px;
 } 


  </style>
</head>

<body>
    <div class="content">
        <div class="width">
                <h3>{{$task->status}}</h3>
                <p>{{$task->dcenter}} | {{$task->reason} | {{$task->urgency}</p>
                <p>{{$task->comment}}</p>
        </div>   
    </div>      
</body>
</html>