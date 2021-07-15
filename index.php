<!DOCTYPE html>
<html>
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
  function getDataPeople()
  {
      $format = 'json';
      $query = 
      "PREFIX f: <http://example.org#> 
      PREFIX rdf: <http://www.w3.org/2001/XMLSchema#> 
      
      SELECT ?s ?p ?o WHERE {?s ?p ?o}";
      
  
      $searchUrl = 'http://localhost:3030/people?query='.urlencode($query).'&format='.$format;
      
      return $searchUrl;
  }

  function getDataJobs()
  {
      $format = 'json';
      $query = 
      "PREFIX f: <http://example.org#> 
      PREFIX rdf: <http://www.w3.org/2001/XMLSchema#> 
      
      SELECT ?s ?p ?o WHERE {?s ?p ?o}";
      
  
      $searchUrl = 'http://localhost:3030/jobs?query='.urlencode($query).'&format='.$format;
      
      return $searchUrl;
  }

  function getDataFamily()
  {
      $format = 'json';
      $query = 
      "PREFIX f: <http://example.org#> 
      PREFIX rdf: <http://www.w3.org/2001/XMLSchema#> 
      
      SELECT ?s ?p ?o WHERE {?s ?p ?o}";
      
  
      $searchUrl = 'http://localhost:3030/family?query='.urlencode($query).'&format='.$format;
      
      return $searchUrl;
  }

  function getDataEmployment()
  {
      $format = 'json';
      $query = 
      "PREFIX f: <http://example.org#> 
      PREFIX rdf: <http://www.w3.org/2001/XMLSchema#> 
      
      SELECT ?s ?p ?o WHERE {?s ?p ?o}";
      
  
      $searchUrl = 'http://localhost:3030/employment?query='.urlencode($query).'&format='.$format;
      
      return $searchUrl;
  }
  ?>

<?php
  $json = file_get_contents(getDataPeople());
  $json = utf8_encode($json);
  $result = json_decode($json, true);
  $result = $result['results']['bindings'];

  $jsonJobs = file_get_contents(getDataJobs());
  $jsonJobs = utf8_encode($jsonJobs);
  $resultJobs = json_decode($jsonJobs, true);
  $resultJobs = $resultJobs['results']['bindings'];

  $jsonFamily = file_get_contents(getDataFamily());
  $jsonFamily = utf8_encode($jsonFamily);
  $resultFamily = json_decode($jsonFamily, true);
  $resultFamily = $resultFamily['results']['bindings'];

  $josnEmployment = file_get_contents(getDataEmployment());
  $josnEmployment = utf8_encode($josnEmployment);
  $resultEmployment = json_decode($josnEmployment, true);
  $resultEmployment = $resultEmployment['results']['bindings'];
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
    <form method="POST" action="hasil.php">
      <div class="container">
        <div class="heading">
        </div>
        <div class="lessons">
          <div class="lesson">
            
              <table style="width: 1100px;">
                
                <tr>
                  <td align="left">Model</td>
                  <td>:</td>
                  <td>
                    <select  class="form-select" name="selectModel" aria-label="Disabled select example">
                      <option selected>Pilih Model</option>
                      <option value="people">People</option>
                      <option value="employment">Employment</option>
                      <option value="family">Family</option>
                      <option value="jobs">Job</option>
                    </select> 
                  </td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td align="center">Subject</td>
                  <td>:</td>
                  <td align="left"><input name="subject"></td>
                </tr>

                <tr>
                  <td align="left">Actions</td>
                  <td>:</td>
                  <td>
                    <select  class="form-select" name="selectAksi" aria-label="Disabled select example">
                      <option selected>Pilih Aksi</option>
                      <option value="describe">Describe</option>
                      <option value="ask">Ask</option>
                      <option value="insert">Insert</option>
                      <option value="delete">Delete</option>
                    </select>     
                  </td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td align="center">Predicate</td>
                  <td>:</td>
                  <td align="left"><input name="predicate"></td>
                </tr>

                <tr>
                  <td align="left">Prefix</td>
                  <td>:</td>
                  <td align="left">
                    <input name="prefix1" size=30>
                  </td>

                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td align="center">Object</td>
                  <td>:</td>
                  <td align="left"><input name="object"></td>
                </tr>

                <tr>
                  <td align="left"></td>
                  <td></td>
                  <td align="left">
                    <input name="prefix2" size=30>
                  </td>
                </tr>
                <tr>
                  <td align="left"></td>
                  <td></td>
                  <td align="left">
                    <input name="prefix3" size=30>
                  </td>
                </tr>
                
              </table>
              
          </div>

         
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <input type="submit" class="btn btn-primary btn-lg btn-block" Value="Run" name="btnSubmit">
      </form> 
    </div>
    <!-- tabel pople -->
    <div style="margin-left:150px">
    <br>
    <br>
      <h2>Tabel People</h2>
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

      <br>
      <br>
      <br>
      <br>
      <!-- tabel jobs -->
      <h2>Tabel Jobs</h2>
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
        foreach ($resultJobs as $row) {
          
        
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
    <br>
      <br>
      <br>
      <br>
      <!-- tabel employment -->
      <h2>Tabel Employment</h2>
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
        foreach ($resultEmployment as $row) {
          
        
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

    <br>
      <br>
      <br>
      <br>
      <!-- tabel Family -->
      <h2>Tabel Family</h2>
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
        foreach ($resultFamily as $row) {
          
        
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
    
    <div class="message-wrapper">
      <div class="container">
      
      </div>
    </div>
    
  </body>
</html>
