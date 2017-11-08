<!DOCTYPE HTML> 
<html> 
<head>
    <title>Page Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    
    <script   src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
</head>

<body id="body-color"> 
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header" id="fireBrick">
    <div class="mdl-layout__header-row">
     <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
    </div>
  </header>

  <main class="mdl-layout__content">
    <section class="page-content">
    <div id="Sign-In"></div>
                  <div class="mdl-card mdl-shadow--6dp">
			<div class="mdl-card__title" id="lightPeriwinkle">
				<h2 class="mdl-card__title-text">Login</h2>
			</div>
	  	<div class="mdl-card__supporting-text">
				<form method="POST" action="login.php">
					<div class="mdl-textfield mdl-js-textfield">
						<input class="mdl-textfield__input" type="text" id="username" />
						<label class="mdl-textfield__label" for="username">Username</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield">
						<input class="mdl-textfield__input" type="password" id="userpass" />
						<label class="mdl-textfield__label" for="userpass">Password</label>
					</div>
				</form>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button class="mdl-button mdl-js-button" id="lightPeriwinkle">Log in</button>
			</div>
		</div>
     </div>          
                 
                
          
      </section>
  </main>
</div>
</body>