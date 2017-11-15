  <header class="mdl-layout__header" id="fireBrick">
    <div class="mdl-layout__header-row">
     <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
 

     
      <div class="mdl-layout-spacer"></div>
      
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
                  
<label id="tt2" class="material-icons mdl-badge mdl-badge--overlap" data-badge="5">account_box</label>  
<div class="mdl-tooltip" for="tt2">Messages</div>                     
                 
<label id="tt3" class="material-icons mdl-badge mdl-badge--overlap" data-badge="4">notifications</label> 
 <div class="mdl-tooltip" for="tt3">Notifications</div>      
 
<a href="logout.php"><label id="tt4" class="material-icons mdl-badge mdl-badge--overlap" >power_settings_new</label></a> 
 <div class="mdl-tooltip" for="tt4">Logout</div> 
                  
        <label class="mdl-button mdl-js-button mdl-button--icon"
               for="fixed-header-drawer-exp">
          <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder mdl-color-text--black">
          <form action="browse-employees.php" method="get">
           <input class="mdl-textfield__input mdl-color-text--white" type="search" name="ln" id="fixed-header-drawer-exp" placeholder="Enter last name">
          </form>
        </div>
        
        
      </div>
    </div>
</header>