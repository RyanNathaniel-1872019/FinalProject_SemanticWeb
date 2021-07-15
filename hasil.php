<html>
<?php
include_once 'Utility.php';
$submitPressed = filter_input(INPUT_POST,"btnSubmit");
if($submitPressed){
    //get data dari form
    $subject = filter_input(INPUT_POST,"subject");
    $predicate = filter_input(INPUT_POST,"predicate");
    $object = filter_input(INPUT_POST,"object");
    $model = filter_input(INPUT_POST,"selectModel");
    $aksi = filter_input(INPUT_POST,"selectAksi");
    $pref1 = filter_input(INPUT_POST,"prefix1");
    $pref2 = filter_input(INPUT_POST,"prefix2");
    $pref3 = filter_input(INPUT_POST,"prefix3");

    if($aksi == "insert"){
        $wsResponse = Utility::curl_post(insert($model,$subject,$predicate,$object,$pref1,$pref2,$pref3), array());
        

        echo '<div class="alert alert-success" role="alert" style="position:absolute;width:20%;top:10%;">Data berhasil ditambah</div>';
    }
    elseif($aksi == "delete"){
      $wsResponse = Utility::curl_post(delete($model,$subject,$predicate,$object,$pref1,$pref2,$pref3), array());
      
        echo '<div class="alert alert-success" role="alert" style="position:absolute;width:20%;top:10%;">Data berhasil dihapus</div>';  
    }
    elseif($aksi == "ask"){
      $wsResponse = Utility::curl_post(ask($model,$subject,$predicate,$object,$pref1,$pref2,$pref3), array());
      $result1 = json_decode($wsResponse, true);
      if($result1['boolean'] ==  "bool(true)" ){
        echo '<div class="alert alert-success" role="alert" style="position:absolute;width:20%;top:10%;">Data ditemukan :)</div>';
      }
      else{
        echo '<div class="alert alert-danger" role="alert" style="position:absolute;width:20%;top:10%;">Data tidak ditemukan :(</div>';
      }
    }
    elseif($aksi == "describe"){
      $wsResponse = Utility::curl_post(describe($model,$subject,$predicate,$object,$pref1,$pref2,$pref3), array());
      $result1 = json_decode($wsResponse, true);
    }
}
?>

<?php
function getAllData($model)
{
    $format = 'json';
    $query = 
    "PREFIX f: <http://example.org#> 
    PREFIX rdf: <http://www.w3.org/2001/XMLSchema#> 
    
    SELECT ?s ?p ?o WHERE {?s ?p ?o}";
    

    $searchUrl = 'http://localhost:3030/'.$model.'?query='.urlencode($query).'&format='.$format;
    
    return $searchUrl;
}

function insert($model,$subject,$predicate,$object,$pref1,$pref2,$pref3)
{
    
  $format = 'json';
  if($pref3 != ""){
    $query = 
    "PREFIX f: <".$pref1."> 
    PREFIX p: <".$pref2."> 
    PREFIX o: <".$pref3.">
    INSERT data {f:".$subject." p:".$predicate." o:".$object."}";
  }
  else{
    $query = 
    "PREFIX f: <".$pref1."> 
    PREFIX p: <".$pref2."> 
    INSERT data {f:".$subject." p:".$predicate."  '".$object."'}";
  }
  $searchUrl = 'http://localhost:3030/'.$model.'?update='.urlencode($query).'&format='.$format;
    
  return $searchUrl;
}

function delete($model,$subject,$predicate,$object,$pref1,$pref2,$pref3)
{
    
  $format = 'json';
  if($pref3 != ""){
    $query = 
    "PREFIX f: <".$pref1."> 
    PREFIX p: <".$pref2."> 
    PREFIX o: <".$pref3.">
    DELETE data {f:".$subject." p:".$predicate." o:".$object."}";
  }
  else{
    $query = 
    "PREFIX f: <".$pref1."> 
    PREFIX p: <".$pref2."> 
    DELETE data {f:".$subject." p:".$predicate."  '".$object."'}";
  }
  $searchUrl = 'http://localhost:3030/'.$model.'?update='.urlencode($query).'&format='.$format;
  
  return $searchUrl;
}

function ask($model,$subject,$predicate,$object,$pref1,$pref2,$pref3)
{ 
    
  $format = 'json';
  if($pref3 != ""){
    $query = 
    "PREFIX f: <".$pref1."> 
    PREFIX p: <".$pref2."> 
    PREFIX o: <".$pref3.">
    ASK WHERE {f:".$subject." p:".$predicate." o:".$object."}";
  }
  else{
    $query = 
    "PREFIX f: <".$pref1."> 
    PREFIX p: <".$pref2."> 
    ASK WHERE {f:".$subject." p:".$predicate."  '".$object."'}";
  }
  // var_dump($subject,$predicate,$object);
  $searchUrl = 'http://localhost:3030/'.$model.'?query='.urlencode($query).'&format='.$format;
  return $searchUrl;
}

function describe($model,$subject,$predicate,$object,$pref1,$pref2,$pref3)
{ 
  $format = 'json';
  
  $query = 
  "PREFIX f: <".$pref1.">
  DESCRIBE ?person WHERE {?person f:".$predicate."  '".$object."'}";

  if($pref2 != ""){
    $query = 
    "PREFIX f: <".$pref1.">
    PREFIX o: <".$pref2.">
    DESCRIBE ?person WHERE {?person f:".$predicate."  o:".$object."}";
  }
  else{
    $query = 
    "PREFIX f: <".$pref1."> 
    DESCRIBE ?person WHERE {?person f:".$predicate."  '".$object."'}";
  }
  
  $searchUrl = 'http://localhost:3030/'.$model.'?query='.urlencode($query).'&format='.$format;
  return $searchUrl;
}

?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tubes Web Semantik</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
  </head>

  <?php
  if(isset($model)){
    $json = file_get_contents(getAllData($model));
    $json = utf8_encode($json);
    $result = json_decode($json, true);
    $result = $result['results']['bindings'];
  }
  
  ?>

  
  <body>
    <header>
      <div class="container">
        <div class="header-left">
          <h2 style="margin-top: 15px; color: white;">SPARQL Jena Fuseki</h2>
        </div>
      </div>
    </header>
    <div class="lesson-wrapper">
      <div class="container">
        <div class="heading">
        </div>
        <div class="lessons">
          <div class="lesson">
          <table class="table table-bordered" style="width: 1100px;">
                <thead>
                <tr>
                  <?php
                  if(isset($result1['firstName'])){
                  ?>
                    <th scope="col">Person</th>
                  <?php
                  }
                  if(isset($result1['hasFriend'])){
                  ?>
                    <th scope="col">has Friend</th>
                  <?php
                  }
                  if( isset($result1['loves'])){
                  ?>
                    <th scope="col">Loves</th>
                  <?php
                  }
                  if(isset($result1['surName'])){
                  ?>
                    <th scope="col">SurName</th>
                  <?php
                  }
                  if(isset($result1['f:age'])){
                  ?>
                    <th scope="col">Age</th>
                  <?php
                  }
                  else{
                  if(isset($aksi)){
                    if($aksi == "describe"){
                  ?>
                  <div class="alert alert-danger" role="alert" style="position:absolute;width:20%;top:10%;">Data tidak ditemukan</div>
                  <?php
                    }
                  }
                  }
                  ?>
                </tr>
                </thead>
                <tbody>
                
                <tr>
                <?php
                  if(isset($result1['firstName'])){
                  ?>
                    <td><?=  $result1['firstName']; ?></td>
                  <?php
                  }
                  if(isset($result1['hasFriend'])){
                  ?>
                    <td><?=  $result1['hasFriend']; ?></td>
                  <?php
                  }
                  if( isset($result1['loves'])){
                  ?>
                    <td><?=  $result1['loves']; ?></td>
                  <?php
                  }
                  if(isset($result1['surName'])){
                  ?>
                    <td><?=  $result1['surName']; ?></td>
                  <?php
                  }
                  if(isset($result1['f:age'])){
                  ?>
                    <td><?=  $result1['f:age']; ?></td>
                  <?php
                  }
                  ?>
                </tr>
                <?php
                // }
                ?>
                </tbody>
            </table>
            </br>



          <table class="table table-bordered" style="width: 1100px;">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Predicate</th>
                    <th scope="col">Object</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                // var_dump($result);
                foreach ($result as $row) {
                  
                
                ?>
                <tr>
                    <th scope="row"><?= $i?></th>
                    <td><?=  $row['s']['value']; ?></td>
                    <td><?=  $row['p']['value']; ?></td>
                    <td><?=  $row['o']['value']; ?></td>
                </tr>
                <?php  
                $i++;
                }
                ?>
                </tbody>
            </table>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <br>
      
    </div>
    <div class="message-wrapper">
      <div class="container">
      
      </div>
    </div>
  </body>
</html>
