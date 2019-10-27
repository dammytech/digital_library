<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Users Dashboard</title>
        <meta name="author" content="MUBARAK MOSHOOD">
       	<meta name=viewport content='width=700'>
		<link rel="stylesheet" href="/lib/w3.css">
		<link rel="stylesheet" type="text/css" href="background.css">
         <href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../stylesheet/fonts/">
        <link rel="stylesheet" type="text/css" href="../stylesheet/bootstrap/css/bootstrap.min.css">
        <script src="../stylesheet/bootstrap/js/jquery-1.11.2.min.js"></script>
        <script src="../stylesheet/bootstrap/js/bootstrap.min.js"></script>
        <style type="text/css">
            .showResultFor{
                border: 1px solid #d9534f;
                border-radius: 15px;
                padding: 3px;
            }
        </style>
    </head>
    <body>
	 <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!--=======================Start Navigation=======================-->
        <div class="container-fluid">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                            <img src="../images/Noun_logo_mini.jpg" width="" height="" alt="NOUN VIRTUAL LIBRARY">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="?logout=yes" class="glyphicon glyphicon-log-out"><b>LOGOUT</b></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--=====================End Navigation=======================-->
            
            <!--=======================Start Content======================-->
            <div class="row">
                <div class="col-md-12">
                    <h3>My Dashboard <small><i>welcome</i> <span style="color: #449d44;" class="text-capitalize"><b>
                        <?php if (isset($user)) { echo $user['first_name']; } ?></b></span></small></h3>
                </div>   
            </div>
            <!--main content-->
			
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading text-center" 
                             style="background-color: forestgreen; color: #F9FFFD; font-size: 15px;">
                            <span class="glyphicon glyphicon-search"></span> SEARCH RESOURCES
                        </div>
						
                        <div class="panel-body">
						
						
                          <h4>Search Resources satisfying the following criteria category:</h4>
                            <div id="demoAcc" class="w3-accordion-content w3-white w3-card-4">
									  <form action="login_processor.php" method="GET">
										<select name="school" class="w3-select" name="option">
                                      <option value="">FACULTIES:</option>
                                      <?php foreach($schools as $school): ?>
                                      <option value="<?php echo $school['id']; ?>"><?php echo $school['name']; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                                  </div>
  
						
					
                            <br><br>
							          <div id="demoAcc" class="w3-accordion-content w3-white w3-card-4">
									  <form action="login_processor.php" method="GET">
										<select name="resource_type"class="w3-select"name="option">
                                      <option value="">COURSES:</option>
                                      <?php foreach($resource_types as $resource_type): ?>
                                      <option value="<?php echo $resource_type['id']; ?>"><?php echo $resource_type['type']; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                                  </div>
							
							
		                   <br><br>
					
                                <div class="form-group">
                                    <label for="containingText"><span class="w3-tangerine">CONTAINING TEXT:</span></label>
                                    <input  class="w3-input w3-border" type="text" name="containingText">
                                </div>
                                <input type="hidden" name="searchQuery" value="search">
                                <div style="text-align: center;"><button type="submit" class="btn btn-success">Search</button></div>
                            </form> 
                        </div>
                    </div>
                    <!--========================OPAC=================-->
                    <div class="panel panel-success">
                        <div class="panel-heading text-center" style="background-color: forestgreen; color: #F9FFFD;
                        font-size: 15px;">
                            OPAC
                        </div>
                        <div class="panel-body">
                            <h4><a href="search-engine/index.php">VIEW OPAC RESOURCES</a></h4>
                        </div>
                    </div>
                </div>
				
                <div class="col-md-6">
                    <?php if (isset($resources)): ?>
                        <!--=============START ALL RESOURCE RESULT==============-->
                        <h2>Showing results for
                            <?php
                                if (!empty($schoolSelected)) {
                                    echo '<span class="showResultFor">' . $schoolSelected[0] . '</span>'  . '&nbsp;';
                                }
                                if (!empty($resourceTypeSelected)) {
                                    echo '<span class="showResultFor">' . $resourceTypeSelected[0] . '</span>'  . '&nbsp;';
                                }
                                if (!empty($containingTextEntered)) {
                                    echo '<span class="showResultFor">' . $containingTextEntered . '</span>' . '&nbsp;';
                                }
                                if (empty($schoolSelected) && empty($resourceTypeSelected) && empty($containingTextEntered)) {
                                    echo '<span class="showResultFor">' . ' All' . '</span>';
                                }
                            ?>
                        </h2>
						
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resources as $resource): ?>   
                                <tr>
                                    <td><?php echo $resource['name']; ?></td>
                                    <td><a href="<?php echo $resource['path']; ?>" 
                                        class="btn btn-xs btn-success" type="file" target="_blank">
                                            <span class="glyphicon glyphicon-book">
                                            </span> Read
                                     </a></td>

                                </tr> 
                                <?php endforeach; ?>
                            </tbody>
                        
                        </table>
                        <!--=============END ALL RESOURCE RESULT==============-->
                    <?php elseif (isset($resultEmpty) && $resultEmpty == 'yes'): ?>
                        <h3>Showing results for
                            <?php
                            if (!empty($schoolSelected)) {
                                echo '<span class="showResultFor">' . $schoolSelected[0] . '</span>'  . '&nbsp;';
                            }
                            if (!empty($resourceTypeSelected)) {
                                echo '<span class="showResultFor">' . $resourceTypeSelected[0] . '</span>'  . '&nbsp;';
                            }
                            if (!empty($containingTextEntered)) {
                                echo '<span class="showResultFor">' . $containingTextEntered . '</span>' . '&nbsp;';
                            }
                            if (empty($schoolSelected) && empty($resourceTypeSelected) && empty($containingTextEntered)) {
                                echo '<span class="showResultFor">' . ' All' . '</span>';
                            }
                            ?>
                        </h3>
                        <h4>
                            Your search criteria does not match any resource in our database.
                        </h4>
                    <?php else: ?>
                        <!--Display Noun's HQ Front gate image-->
                        <img src="../images/NOUN.jpg" class="img-responsive" alt="NOUN VIRTUAL LIBRARY">
                        <h3 style="background-color: forestgreen; color: #F9FFFD; font-size: 20px;"
                                class="text-center">
                                Welcome To Noun Virtual Library
                        </h3>
                    <?php endif; ?>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading text-center" 
                             style="background-color: forestgreen; color: #F9FFFD; font-size: 15px;">
                            <span class="glyphicon glyphicon-user"></span> <i>MY PROFILE</i>
                        </div>
                        <div class="panel-body">
                            <p style="color: red;">
                                <?php
                                    if (isset($_COOKIE['update_f'])) {
                                        echo $_COOKIE['update_f'];
                                    }
                                ?>
                            </p>
                            <p style="color: green;">
                                <?php
                                    if (isset($_COOKIE['update'])) {
                                        echo $_COOKIE['update'];
                                    }
                                ?>
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php if (!empty($user['avatar_path'])): ?>
                                    <img src="../images/findbook.jpg" class="w3-circle" 
                                         alt="NOUN VIRTUAL LIBRARY" 
                                         style="border: 1px solid grey;" width="100" height="100"><br/>
                                    <?php else: ?>
                                    <img src="../images/findbook.jpg" class="w3-circle" 
                                         alt="NOUN VIRTUAL LIBRARY" 
                                         style="border: 1px solid grey;" width="100" height="100"><br/>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <!--<a class="btn btn-xs btn-danger" data-toggle="modal"
                                           href="#uploadModal">
                                        <span class="glyphicon glyphicon-picture"></span> Upload
                                    </a>-->
                                    <!--Upload Modal-->
                                    <div id="uploadModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!--Modal Content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form action="login_processor.php" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="upload">Select file to upload:</label>
                                                            <input id="upload" name="upload" type="file" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="upload_image" value="<?php echo $user['id']; ?>">
                                                            <input type="submit" class="btn btn-default" value="Submit">
                                                            <button type="button" class="btn btn-default" 
                                                                    data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-capitalize"><span class="glyphicon glyphicon-user">
                                        <?php echo $user['first_name'];
                                        echo ' ';
                                        echo $user['last_name']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><span class="glyphicon glyphicon-envelope"> Email:</span>
                                        <?php echo $user['email']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="login_processor.php" method="POST">
                                        <span style="background-color: forestgreen; 
                                            color: #F9FFFD;">
                                            <button class="btn btn-block btn-success" 
                                                    style="font-size: 10px;">UPDATE PROFILE</button>
                                        </span>
                                        <input type="hidden" name="update_profile_id" value="<?php echo $user['id']; ?>">
                                        <input type="hidden" name="update_profile_email" value="<?php echo $user['email']; ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading text-center" 
                             style="background-color: forestgreen; color: #F9FFFD; font-size: 15px;">
                            <span class="glyphicon glyphicon-info"></span> <i>Other E-Resources</i>
                        </div>
                        <div class="panel-body">
                            <p style="color: red;">
                              <ul>
							  <li><a href="http://search.ebscohost.com/"target="_blank" >EBSCOHOST</a></li>
							  <li><a href="http://www.lawpavilionplus.com/"target="_blank" >LAWPAVILIONPLUS</a></li>
							  <li><a href="http://www.jstor.org" target="_blank">JSTOR</a></li>
							  <li><a href="http://www.who.int/hinari/training/en/"target="_blank" >HINARI</a></li>
							  <li><a href="http://oare.oaresciences.org/content/en/journals.php"target="_blank" >OARE</a></li>
							  </ul>
                            </p>
                            <p style="color: green;">
                            </p>
						
						<div class="panel panel-success">
                        <div class="panel-heading text-center" style="background-color: forestgreen; color: #F9FFFD;
                        font-size: 15px;">
						
                            E-Resources Password
                        </div>
                        
						<p>
						<div class="panel-body">
						  <button class="w3-btn w3-green" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
							Click to view E-Resources Password
						  </button>
							</p>
							<div class="collapse" id="collapseExample">
							
							  <div class="card card-block">
							  <style type="text/css">
							  table, th, td {border: 1px solid grey;border-collapse: collapse;}
							  th, td ,tr{padding: 0px; width:0%}
				               </style>
							   
							  <table class="table">
							  <thead>
								<tr>
								  <th>S/N</th>
								  <th>Resources</th>
								  <th>Username</th>
								  <th>Password</th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <th scope="row">1</th>
								  <td>ebscohost</td>
								  <td>ns021506</td>
								  <td>password</td>
								  
								</tr>
								<tr>
								  <th scope="row">2</th>
								  <td>LAW
								  PAVILION
								  PLUS</td>
								  <td>noun
								  library18
								@gmail.com</td>
								  <td>password</td>
							
								</tr>
								<tr>
								  <th scope="row">3</th>
								  <td>JSTOR</td>
								  <td>NOUN
							LIBRARY</td>
								  <td>learning</td>
								</tr>
								
								<tr>
								  <th scope="row">4</th>
								  <td>HINARI</td>
								  <td>NIE125</td>
								  <td>26379</td>
								</tr>
								
                                 </div>		  
							  </div>
							</div>
							
							  </tbody>
							  
							</table>
							</tr>
							
							</table>
									 
							</div>
													  
							  </div>					
							</div>
							</div>
							</div>
							</div>
							 </div>
							 
							</div>
							<br><br>
				
						  </div>
						</div>	
	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/><br/><br/><br/><br/><br/><br/>
            <!--=================End Content==================-->
            
            <!--=================Start Footer==================-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="well well-lg text-center" style="background-color:black;">
                        <span class="text-warning">COPYRIGHT &copy; 2017</span> 
                        <span style="color: forestgreen;">NOUN</span>
                    </div>
                </div>
            </div>
            <!--=================End Footer==================-->
        </div><!--end container-->
    </body>
</html>

